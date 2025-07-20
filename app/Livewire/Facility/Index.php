<?php

namespace App\Livewire\Facility;

use Livewire\Component;
use App\Models\Facility;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('UTM Voice | Facilities')]
class Index extends Component
{
    #[Computed()]
    public function facilities()
    {
        return Facility::latest()->paginate(6);
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
