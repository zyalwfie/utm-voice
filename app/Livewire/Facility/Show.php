<?php

namespace App\Livewire\Facility;

use App\Livewire\Forms\EvaluateForm;
use Livewire\Component;
use App\Models\Facility;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\ReviewForm;
use App\Models\Question;
use App\Models\User;
use Livewire\WithFileUploads;

#[Title('UTM Voice | Fasilitas')]
class Show extends Component
{
    use WithFileUploads;

    public Facility $facility;
    public ReviewForm $form;
    public EvaluateForm $evaluateForm;
    public ?User $student = null;
    public bool $showAllComments = false;
    public bool $isStudentIdValid = false;
    public bool $isEvaluateFormStudentId = false;
    public $sortKey = '';

    public function mount(Facility $facility)
    {
        $this->facility = $facility;
        $this->form->facility_id = $this->facility->id;
    }

    #[Computed()]
    public function comments()
    {
        Carbon::setLocale('id');

        $query = $this->facility->comments()->with('user')->latest();

        if (!empty($this->sortKey) && $this->sortKey !== '') {
            $query = $query->where('rating', (int) $this->sortKey);

            if ($this->showAllComments) {
                return $query->get();
            }

            return $query->take(3)->get();
        }

        if ($this->showAllComments) {
            return $query->get();
        }

        return $query->take(3)->get();
    }

    #[Computed()]
    public function questions()
    {
        return Question::where('facility_id', $this->facility->id)->get();
    }

    public function loadAllComments()
    {
        $this->showAllComments = !$this->showAllComments;
    }

    public function updatedSortKey($value)
    {
        $this->showAllComments = false;

        $this->sortKey = $value;
    }

    public function getTotalCommentsCount()
    {
        if (!empty($this->sortKey) && $this->sortKey !== '') {
            return $this->facility->comments()->where('rating', (int) $this->sortKey)->count();
        }

        return $this->facility->comments()->count();
    }

    public function shouldShowLoadMoreButton()
    {
        return $this->getTotalCommentsCount() > 3;
    }

    public function updatedFormStudentId($value)
    {
        $this->student = User::where('student_id', $value)->first();
        $this->isStudentIdValid = $this->student !== null;
    }

    public function updatedEvaluateFormStudentId($value)
    {
        $this->student = User::where('student_id', $value)->first();
        $this->isEvaluateFormStudentId = $this->student !== null;
    }

    public function createNewReview()
    {
        $this->form->store();

        session()->flash('success', 'Ulasan baru berhasil ditambahkan.');
    }

    public function createNewQuestionnaire()
    {
        $this->evaluateForm->store();

        session()->flash('success', 'Kuesioner berhasil dikirim.');
    }

    public function render()
    {
        return view('livewire.facility.show');
    }
}
