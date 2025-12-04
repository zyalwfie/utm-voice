<?php

namespace App\Livewire\User\Questionnaire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Answer;
use App\Models\Question;

#[Layout('components.layouts.user')]
#[Title('Kuesioner Saya')]
class Index extends Component
{
    public $query = '';
    public $filterFacility = '';

    // Modal states
    public $showViewModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    // Form data
    public $selectedAnswerId = null;
    public $editContent = '';

    #[Computed]
    public function answers()
    {
        return Answer::with(['question.facility'])
            ->where('user_id', auth()->id())
            ->when($this->query, function ($q) {
                $q->where('content', 'like', '%' . $this->query . '%')
                    ->orWhereHas('question', function ($q) {
                        $q->where('content', 'like', '%' . $this->query . '%');
                    });
            })
            ->when($this->filterFacility, function ($q) {
                $q->whereHas('question.facility', function ($q) {
                    $q->where('id', $this->filterFacility);
                });
            })
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function facilities()
    {
        return \App\Models\Facility::whereHas('questions.answers', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();
    }

    #[Computed]
    public function selectedAnswer()
    {
        if (!$this->selectedAnswerId) {
            return null;
        }

        return Answer::with(['question.facility'])
            ->where('user_id', auth()->id())
            ->find($this->selectedAnswerId);
    }

    public function openViewModal($answerId)
    {
        $this->selectedAnswerId = $answerId;
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->selectedAnswerId = null;
    }

    public function openEditModal($answerId)
    {
        $answer = Answer::where('user_id', auth()->id())->find($answerId);

        if ($answer) {
            $this->selectedAnswerId = $answerId;
            $this->editContent = $answer->content;
            $this->showEditModal = true;
        }
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->selectedAnswerId = null;
        $this->editContent = '';
    }

    public function updateAnswer()
    {
        $this->validate([
            'editContent' => 'required|min:10',
        ], [
            'editContent.required' => 'Jawaban tidak boleh kosong.',
            'editContent.min' => 'Jawaban minimal 10 karakter.',
        ]);

        $answer = Answer::where('user_id', auth()->id())->find($this->selectedAnswerId);

        if ($answer) {
            $answer->update([
                'content' => $this->editContent,
            ]);

            session()->flash('success', 'Jawaban berhasil diperbarui.');
            $this->closeEditModal();
        }
    }

    public function openDeleteModal($answerId)
    {
        $this->selectedAnswerId = $answerId;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedAnswerId = null;
    }

    public function deleteAnswer()
    {
        $answer = Answer::where('user_id', auth()->id())->find($this->selectedAnswerId);

        if ($answer) {
            $answer->delete();
            session()->flash('success', 'Jawaban berhasil dihapus.');
        }

        $this->closeDeleteModal();
    }

    public function render()
    {
        return view('livewire.user.questionnaire.index');
    }
}
