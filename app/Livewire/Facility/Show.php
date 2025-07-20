<?php

namespace App\Livewire\Facility;

use App\Models\Comment;
use App\Models\Facility;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Show extends Component
{
    public Facility $facility;
    public bool $showAllComments = false;

    public function mount(Facility $facility)
    {
        $this->facility = $facility;
    }

    public function loadAllComments()
    {
        $this->showAllComments = !$this->showAllComments;
    }

    #[Computed()]
    public function comments()
    {
        Carbon::setLocale('id');

        if ($this->showAllComments) {
            return $this->facility->comments;
        }

        return $this->facility->comments->take(3);
    }

    public function render()
    {
        return view('livewire.facility.show');
    }
}
