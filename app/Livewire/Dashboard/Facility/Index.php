<?php

namespace App\Livewire\Dashboard\Facility;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Facility;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $sortKey = '';

    // Form properties for creating/updating facilities
    public $selectedFacilityId = null;
    public $facilityName = '';
    public $slug = '';
    public $facilityDescription = '';
    public $selectedTags = [];
    public $newTagName = '';

    // Modal state management
    public $showCreateModal = false;
    public $showUpdateModal = false;

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedSortKey()
    {
        $this->resetPage();
    }

    // Open create modal
    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
        $this->dispatch('modal-opened', 'createFacilityModal');
    }

    // Close create modal
    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->resetForm();
        $this->dispatch('modal-closed', 'createFacilityModal');
    }

    // Method to add tag to selection WITHOUT triggering full re-render
    public function addTagToSelection($tagName)
    {
        if ($tagName && !in_array($tagName, $this->selectedTags)) {
            $this->selectedTags[] = $tagName;
        }

        // Don't reset or trigger heavy operations
        // This keeps the modal open and maintains FilePond state
    }

    // Method to remove tag from selected tags array
    public function removeTagFromSelection($tagName)
    {
        $this->selectedTags = array_filter($this->selectedTags, function ($tag) use ($tagName) {
            return $tag !== $tagName;
        });
    }

    // Method to create a new tag
    public function createNewTag()
    {
        $this->validate([
            'newTagName' => 'required|string|max:255|unique:tags,name'
        ]);

        Tag::create(['name' => $this->newTagName]);

        // Add the new tag to selection
        $this->selectedTags[] = $this->newTagName;

        $this->reset('newTagName');

        $this->dispatch('tag-created', $this->newTagName);
    }

    // Method to create a new facility with tags
    public function createFacility()
    {
        $this->validate([
            'facilityName' => 'required|string|max:255',
            'facilityDescription' => 'required|string',
            'selectedTags' => 'array',
        ]);

        $facility = Facility::create([
            'name' => $this->facilityName,
            'slug' => Str::slug($this->facilityName),
            'description' => $this->facilityDescription,
        ]);

        // Attach multiple tags at once
        if (!empty($this->selectedTags)) {
            $facility->attachTags($this->selectedTags);
        }

        $this->closeCreateModal();
        session()->flash('message', 'Fasilitas berhasil dibuat.');

        // Trigger page refresh for the table
        $this->dispatch('facility-created');
    }

    // Method to attach a tag to existing facility
    public function attachTagToFacility($facilityId, $tagName)
    {
        $facility = Facility::findOrFail($facilityId);
        $facility->attachTag($tagName);

        session()->flash('message', 'Tag berhasil ditambahkan ke fasilitas.');
    }

    // Method to remove a tag from a facility
    public function detachTagFromFacility($facilityId, $tagName)
    {
        $facility = Facility::findOrFail($facilityId);
        $facility->detachTag($tagName);

        session()->flash('message', 'Tag berhasil dihapus dari fasilitas.');
    }

    private function resetForm()
    {
        $this->reset([
            'facilityName',
            'facilityDescription',
            'selectedTags',
            'selectedFacilityId',
            'newTagName'
        ]);
    }

    #[Computed()]
    public function tags()
    {
        return Tag::query()->withCount('facilities')->get();
    }

    #[Computed()]
    public function facilities()
    {
        $query = Facility::where('name', 'like', "%{$this->query}%")
            ->with(['tags'])
            ->withAvg('comments', 'rating');

        if ($this->sortKey === 'rating') {
            $query->orderBy('comments_avg_rating', 'desc');
        } elseif ($this->sortKey) {
            $query->orderBy($this->sortKey);
        }

        return $query->paginate(5);
    }

    public function render()
    {
        return view('livewire.dashboard.facility.index');
    }
}
