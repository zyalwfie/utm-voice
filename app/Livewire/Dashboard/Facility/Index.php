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

    public $selectedFacilityId = null;
    public $facilityName = '';
    public $slug = '';
    public $facilityDescription = '';
    public $selectedTags = [];
    public $newTagName = '';

    public $carouselFiles = [];
    public $detailFiles = [];

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

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
        $this->dispatch('modal-opened', 'createFacilityModal');
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->resetForm();
        $this->dispatch('modal-closed', 'createFacilityModal');
    }

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

    public function closeUpdateModal()
    {
        $this->showUpdateModal = false;
        $this->resetForm();
        $this->dispatch('modal-closed', 'updateFacilityModal');
    }

    public function openDeleteModal($facilityId)
    {
        $this->selectedFacilityId = $facilityId;
        $this->showDeleteModal = true;
        $this->dispatch('modal-opened', 'deleteModal');
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedFacilityId = null;
        $this->dispatch('modal-closed', 'deleteModal');
    }

    public function addTagToSelection($tagName)
    {
        if ($tagName && !in_array($tagName, $this->selectedTags)) {
            $this->selectedTags[] = $tagName;
        }
    }

    public function removeTagFromSelection($tagName)
    {
        $this->selectedTags = array_filter($this->selectedTags, function ($tag) use ($tagName) {
            return $tag !== $tagName;
        });
    }

    public function createNewTag()
    {
        $this->validate([
            'newTagName' => 'required|string|max:255|unique:tags,name'
        ]);

        Tag::create(['name' => $this->newTagName]);

        $this->selectedTags[] = $this->newTagName;

        $this->reset('newTagName');

        $this->dispatch('tag-created', $this->newTagName);
    }

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

        if (!empty($this->selectedTags)) {
            $facility->attachTags($this->selectedTags);
        }

        foreach ($this->carouselFiles as $filename) {
            $tempPath = storage_path('app/public/temp/carousel/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('carousel');

                unlink($tempPath);
            }
        }

        foreach ($this->detailFiles as $filename) {
            $tempPath = storage_path('app/public/temp/detail/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('detail');

                unlink($tempPath);
            }
        }

        $this->closeCreateModal();
        session()->flash('message', 'Fasilitas berhasil dibuat.');

        $this->dispatch('facility-created');
    }

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

        $facility->syncTags($this->selectedTags);

        foreach ($this->carouselFiles as $filename) {
            $tempPath = storage_path('app/public/temp/carousel/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('carousel');

                unlink($tempPath);
            }
        }

        foreach ($this->detailFiles as $filename) {
            $tempPath = storage_path('app/public/temp/detail/' . $filename);
            if (file_exists($tempPath)) {
                $facility->addMedia($tempPath)
                    ->toMediaCollection('detail');

                unlink($tempPath);
            }
        }

        $this->closeUpdateModal();
        session()->flash('message', 'Fasilitas berhasil diperbarui.');
    }

    public function deleteFacility()
    {
        $facility = Facility::findOrFail($this->selectedFacilityId);

        $facility->clearMediaCollection('carousel');
        $facility->clearMediaCollection('detail');

        $facility->delete();

        $this->closeDeleteModal();
        session()->flash('message', 'Fasilitas berhasil dihapus.');
    }

    public function deleteMedia($mediaId)
    {
        $facility = Facility::findOrFail($this->selectedFacilityId);
        $media = $facility->getMedia()->find($mediaId);

        if ($media) {
            $media->delete();
            session()->flash('message', 'Gambar berhasil dihapus.');
        }
    }

    public function attachTagToFacility($facilityId, $tagName)
    {
        $facility = Facility::findOrFail($facilityId);
        $facility->attachTag($tagName);

        session()->flash('message', 'Tag berhasil ditambahkan ke fasilitas.');
    }

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
