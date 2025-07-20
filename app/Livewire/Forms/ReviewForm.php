<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use App\Models\Comment;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ReviewForm extends Form
{
    use WithFileUploads;

    #[Validate('required|exists:users,student_id')]
    public $student_id = '';

    #[Validate('required')]
    public $facility_id = '';

    #[Validate('required')]
    public $rating = '';

    #[Validate('required')]
    public $content = '';

    public $student_name = '';

    public function store()
    {
        $student = User::where('student_id', $this->student_id)->first();

        $validated = $this->validate();

        Comment::insert([
            'facility_id' => $validated['facility_id'],
            'user_id' => $student->id,
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->reset();
    }
}
