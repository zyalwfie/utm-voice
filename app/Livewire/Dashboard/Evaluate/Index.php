<?php

namespace App\Livewire\Dashboard\Evaluate;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Question;
use App\Models\Answer;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

#[Layout('components.layouts.admin')]
#[Title('UTM Voice | Dasbor | Kuesioner')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $sortKey = '';
    public $facilityId = '';
    public $question = '';
    public $selectedQuestionId = null;

    public $showCreateModal = false;
    public $showUpdateModal = false;
    public $showDeleteModal = false;
    public $showAnswersModal = false;

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedSortKey()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
        $this->dispatch('modal-opened', 'createModal');
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->resetForm();
        $this->dispatch('modal-closed', 'createModal');
    }

    public function openUpdateModal($questionId)
    {
        $question = Question::findOrFail($questionId);

        $this->selectedQuestionId = $question->id;
        $this->facilityId = $question->facility_id;
        $this->question = $question->content;

        $this->showUpdateModal = true;
        $this->dispatch('modal-opened', 'updateModal');
    }

    public function closeUpdateModal()
    {
        $this->showUpdateModal = false;
        $this->resetForm();
        $this->dispatch('modal-closed', 'updateModal');
    }

    public function openDeleteModal($questionId)
    {
        $this->selectedQuestionId = $questionId;
        $this->showDeleteModal = true;
        $this->dispatch('modal-opened', 'deleteModal');
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedQuestionId = null;
        $this->dispatch('modal-closed', 'deleteModal');
    }

    public function openAnswersModal($questionId)
    {
        $this->selectedQuestionId = $questionId;
        $this->showAnswersModal = true;
        $this->dispatch('modal-opened', 'answersModal');
    }

    public function closeAnswersModal()
    {
        $this->showAnswersModal = false;
        $this->selectedQuestionId = null;
        $this->dispatch('modal-closed', 'answersModal');
    }

    private function resetForm()
    {
        $this->reset([
            'facilityId',
            'question',
            'selectedQuestionId'
        ]);
    }

    #[Computed()]
    public function questions()
    {
        $query = Question::where('content', 'like', "%{$this->query}%")
            ->with(['facility', 'answers'])
            ->withCount('answers');

        if ($this->sortKey === 'facility') {
            $query->join('facilities', 'questions.facility_id', '=', 'facilities.id')
                ->orderBy('facilities.name');
        } elseif ($this->sortKey === 'answers_count') {
            $query->orderBy('answers_count', 'desc');
        } elseif ($this->sortKey) {
            $query->orderBy($this->sortKey);
        }

        return $query->paginate(10);
    }

    #[Computed()]
    public function facilities()
    {
        return Facility::all();
    }

    #[Computed()]
    public function selectedQuestionAnswers()
    {
        if (!$this->selectedQuestionId) {
            return collect();
        }

        return Answer::where('question_id', $this->selectedQuestionId)
            ->with(['user'])
            ->latest()
            ->get();
    }

    public function createNewQuestion()
    {
        $this->validate([
            'facilityId' => 'required|exists:facilities,id',
            'question' => 'required|string|max:500'
        ]);

        Question::create([
            'facility_id' => $this->facilityId,
            'content' => $this->question
        ]);

        $this->closeCreateModal();
        $this->resetPage();

        session()->flash('success', 'Kuesioner berhasil dibuat.');
    }

    public function updateQuestion()
    {
        $this->validate([
            'facilityId' => 'required|exists:facilities,id',
            'question' => 'required|string|max:500'
        ]);

        $question = Question::findOrFail($this->selectedQuestionId);

        $question->update([
            'facility_id' => $this->facilityId,
            'content' => $this->question
        ]);

        $this->closeUpdateModal();
        session()->flash('success', 'Kuesioner berhasil diperbarui.');
    }

    public function deleteQuestion()
    {
        $question = Question::findOrFail($this->selectedQuestionId);

        $question->answers()->delete();

        $question->delete();

        $this->closeDeleteModal();
        session()->flash('success', 'Kuesioner berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.dashboard.evaluate.index');
    }
}
