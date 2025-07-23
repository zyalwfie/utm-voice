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
use Illuminate\Support\Facades\Storage;

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

    // File upload properties - store file paths from FilePond
    public $carouselFiles = [];
    public $detailFiles = [];

    // Modal state management
    public $showCreateModal = false;
    public $showUpdateModal = false;
    public $showDeleteModal = false;

    protected $listeners = [
        'carouselUploaded' => 'handleCarouselUpload',
        'detailUploaded' => 'handleDetailUpload',
        'fileRemoved' => 'handleFileRemoval'
    ];

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedSortKey()
    {
        $this->resetPage();
    }

    // Handle file uploads from FilePond via JavaScript
    public function handleCarouselUpload($filename)
    {
        $this->carouselFiles[] = $filename;
    }

    public function handleDetailUpload($filename)
    {
        $this->detailFiles[] = $filename;
    }

    public function handleFileRemoval($filename, $type)
    {
        if ($type === 'carousel') {
            $this->carouselFiles = array_filter($this->carouselFiles, fn($file) => $file !== $filename);
        } elseif ($type === 'detail') {
            $this->detailFiles = array_filter($this->detailFiles, fn($file) => $file !== $filename);
        }
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

    // Open update modal
    public function openUpdateModal($facilityId)
    {
        $facility = Facility::findOrFail($facilityId);

        $this->selectedFacilityId = $facility->id;
        $this->facilityName = $facility->name;
        $this->facilityDescription = $facility->description;
        $this->selectedTags = $facility->tags->pluck('name')->toArray();

        $this->showUpdateModal = true;
        $this->dispatch('modal-opened', 'updateFacilityModal');
    }

    // Close update modal
    public function closeUpdateModal()
    {
        $this->showUpdateModal = false;
        $this->resetForm();
        $this->dispatch('modal-closed', 'updateFacilityModal');
    }

    // Open delete modal
    public function openDeleteModal($facilityId)
    {
        $this->selectedFacilityId = $facilityId;
        $this->showDeleteModal = true;
        $this->dispatch('modal-opened', 'deleteModal');
    }

    // Close delete modal
    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedFacilityId = null;
        $this->dispatch('modal-closed', 'deleteModal');
    }

    // Method to add tag to selection WITHOUT triggering full re-render
    public function addTagToSelection($tagName)
    {
        if ($tagName && !in_array($tagName, $this->selectedTags)) {
            $this->selectedTags[] = $tagName;
        }
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

    // Method to create a new facility with tags and images
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

        // Handle carousel images - move from temp to media library
        foreach ($this->carouselFiles as $filename) {
            $tempPath = storage_path('app/public/temp/carousel/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('carousel');

                // Delete temp file
                unlink($tempPath);
            }
        }

        // Handle detail images - move from temp to media library
        foreach ($this->detailFiles as $filename) {
            $tempPath = storage_path('app/public/temp/detail/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('detail');

                // Delete temp file
                unlink($tempPath);
            }
        }

        $this->closeCreateModal();
        session()->flash('message', 'Fasilitas berhasil dibuat.');

        // Trigger page refresh for the table
        $this->dispatch('facility-created');
    }

    // Method to update facility
    public function updateFacility()
    {
        $this->validate([
            'facilityName' => 'required|string|max:255',
            'facilityDescription' => 'required|string',
            'selectedTags' => 'array',
        ]);

        $facility = Facility::findOrFail($this->selectedFacilityId);

        $facility->update([
            'name' => $this->facilityName,
            'slug' => Str::slug($this->facilityName),
            'description' => $this->facilityDescription,
        ]);

        // Sync tags
        $facility->syncTags($this->selectedTags);

        // Handle new carousel images - move from temp to media library
        foreach ($this->carouselFiles as $filename) {
            $tempPath = storage_path('app/public/temp/carousel/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('carousel');

                // Delete temp file
                unlink($tempPath);
            }
        }

        // Handle new detail images - move from temp to media library
        foreach ($this->detailFiles as $filename) {
            $tempPath = storage_path('app/public/temp/detail/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('detail');

                // Delete temp file
                unlink($tempPath);
            }
        }

        $this->closeUpdateModal();
        session()->flash('message', 'Fasilitas berhasil diperbarui.');
    }

    // Method to delete facility
    public function deleteFacility()
    {
        $facility = Facility::findOrFail($this->selectedFacilityId);

        // Delete all media files
        $facility->clearMediaCollection('carousel');
        $facility->clearMediaCollection('detail');

        // Delete the facility
        $facility->delete();

        $this->closeDeleteModal();
        session()->flash('message', 'Fasilitas berhasil dihapus.');
    }

    // Method to delete specific media
    public function deleteMedia($mediaId)
    {
        $facility = Facility::findOrFail($this->selectedFacilityId);
        $media = $facility->getMedia()->find($mediaId);

        if ($media) {
            $media->delete();
            session()->flash('message', 'Gambar berhasil dihapus.');
        }
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
            'newTagName',
            'carouselFiles',
            'detailFiles'
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
            ->with(['tags', 'media'])
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
