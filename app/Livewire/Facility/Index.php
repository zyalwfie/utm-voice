<?php

namespace App\Livewire\Facility;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Facility;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

#[Title('UTM Voice | Fasilitas')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $sortKey = '';

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedSortKey()
    {
        $this->resetPage();
    }

    public function updatedSelectedTags()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset('sortKey');
        $this->resetPage();
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
            ->with(['tags']);

        if (!empty($this->selectedTags)) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('name', $this->selectedTags);
            });
        }

        if ($this->sortKey === 'name') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate(6);
    }

    #[Computed()]
    public function facilityCount()
    {
        return Facility::count();
    }

    public function render()
    {
        return view('livewire.facility.index');
    }
}
