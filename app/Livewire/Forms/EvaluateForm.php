<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use App\Models\Answer;
use Livewire\Attributes\Validate;

class EvaluateForm extends Form
{
    #[Validate('required')]
    public $question_id = '';

    #[Validate('required|exists:users,student_id')]
    public $student_id = '';

    #[Validate('required')]
    public $answer = '';

    public function store()
    {
        dd($this->all());

        $student = User::where('student_id', $this->student_id)->first();

        $validated = $this->validate();

        Answer::insert([
            'question_id' => $validated['question_id'],
            'user_id' => $student->id,
            'content' => $validated['content'],
        ]);

        $this->reset();
    }
}
