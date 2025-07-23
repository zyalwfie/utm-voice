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

    public function search()
    {
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
            ->with(['tags'])
            ->withAvg('comments', 'rating');

        if ($this->sortKey === 'rating') {
            $query->orderBy('comments_avg_rating', 'desc');
        } elseif ($this->sortKey) {
            $query->orderBy($this->sortKey);
        }

        $query->paginate(6);

        return $query->paginate(6);
    }

    #[Computed()]
    public function facilityCount()
    {
        return count(Facility::all());
    }

    public function render()
    {
        return view('livewire.facility.index');
    }
}
