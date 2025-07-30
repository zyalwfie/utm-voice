<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use App\Models\Answer;
use Livewire\Attributes\Validate;

class EvaluateForm extends Form
{
    #[Validate('required|exists:users,student_id')]
    public $student_id = '';

    public $answers = [];

    public function store()
    {
        $student = User::where('student_id', $this->student_id)->first();

        $this->validate();

        $this->validate([
            'answers' => 'required|array|min:1',
            'answers.*' => 'required|string|min:1'
        ], [
            'answers.required' => 'Harap isi semua pertanyaan kuesioner.',
            'answers.*.required' => 'Harap isi jawaban untuk pertanyaan ini.',
            'answers.*.min' => 'Jawaban minimal harus 1 karakter.'
        ]);

        foreach ($this->answers as $questionId => $answer) {
            Answer::create([
                'question_id' => $questionId,
                'user_id' => $student->id,
                'content' => $answer,
            ]);
        }

        $this->reset();
    }

    public function setAnswer($questionId, $answer)
    {
        $this->answers[$questionId] = $answer;
    }
}
