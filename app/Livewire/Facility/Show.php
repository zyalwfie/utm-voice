<?php

namespace App\Livewire\Facility;

use App\Models\Facility;
use App\Models\Question;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('UTM Voice | Fasilitas')]
class Show extends Component
{
    use WithFileUploads;

    public Facility $facility;

    public ?User $student = null;

    public function mount(Facility $facility)
    {
        $this->facility = $facility;
    }

    #[Computed()]
    public function questions()
    {
        return Question::where('facility_id', $this->facility->id)->get();
    }

    public function render()
    {
        return view('livewire.facility.show');
    }
}
