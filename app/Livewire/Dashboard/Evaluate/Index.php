<?php

namespace App\Livewire\Dashboard\Evaluate;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Question;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

#[Layout('components.layouts.dashboard')]
#[Title('UTM Voice | Dasbor | Kuesioner')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $sortKey = '';
    public $facilityId = '';
    public $question = '';

    public $showCreateModal = false;

    public function toggleOpenModal()
    {
        $this->showCreateModal = !$this->showCreateModal;
    }

    #[Computed()]
    public function questions()
    {
        return Question::all();
    }

    #[Computed()]
    public function facilities()
    {
        return Facility::all();
    }

    public function createNewQuestion()
    {
        Question::create([
            'facility_id' => $this->facilityId,
            'content' => $this->question
        ]);

        $this->toggleOpenModal();

        $this->resetPage();

        session()->flash('success', 'Kuesioner berhasil dibuat.');
    }

    public function render()
    {
        return view('livewire.dashboard.evaluate.index');
    }
}
