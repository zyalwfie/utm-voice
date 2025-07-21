<?php

namespace App\Livewire\Dashboard\Facility;

use Livewire\Component;
use App\Models\Facility;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $sortKey = '';

    #[Computed()]
    public function facilities()
    {
        $query = Facility::where('name', 'like', "%{$this->query}%")
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
