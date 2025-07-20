<?php

namespace App\Livewire\Facility;

use Livewire\Component;
use App\Models\Facility;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\ReviewForm;
use App\Models\User;
use Livewire\WithFileUploads;

#[Title('UTM Voice | Fasilitas')]
class Show extends Component
{
    use WithFileUploads;

    public Facility $facility;
    public ReviewForm $form;
    public ?User $student = null;
    public bool $showAllComments = false;
    public bool $isStudentIdValid = false;

    public function mount(Facility $facility)
    {
        $this->facility = $facility;
        $this->form->facility_id = $this->facility->id;
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
            return $this->facility->comments()->latest()->get();
        }

        return $this->facility->comments()->latest()->take(3)->get();
    }

    public function updatedFormStudentId($value)
    {
        $this->student = User::where('student_id', $value)->first();
        $this->isStudentIdValid = $this->student !== null;
    }

    public function createNewReview()
    {
        $this->form->store();

        session()->flash('success', 'Ulasan baru berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.facility.show');
    }
}
