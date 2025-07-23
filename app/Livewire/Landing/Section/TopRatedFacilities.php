<?php

namespace App\Livewire\Landing\Section;

use Livewire\Component;
use App\Models\Facility;
use Livewire\Attributes\Computed;

class TopRatedFacilities extends Component
{
    #[Computed()]
    public function facilities()
    {
        return Facility::all()->take(4);
    }

    public function render()
    {
        return view('livewire.landing.section.top-rated-facilities');
    }
}
