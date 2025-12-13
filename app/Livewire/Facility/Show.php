<?php

namespace App\Livewire\Facility;

use App\Models\Answer;
use App\Models\Facility;
use App\Models\Period;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('UTM Voice | Fasilitas')]
class Show extends Component
{
    public Facility $facility;
    public $periods;

    // Form properties
    public array $questionnaireForm = [
        'student_id' => '',
        'answers' => [],
    ];

    public function mount(Facility $facility)
    {
        $this->facility = $facility;
        $this->periods = Period::currentOpen();

        // Auto-fill student_id from authenticated user
        if (Auth::check()) {
            $this->questionnaireForm['student_id'] = Auth::user()->student_id ?? '';
        }
    }

    #[Computed()]
    public function questions()
    {
        return Question::where('facility_id', $this->facility->id)->get();
    }

    /**
     * Validation rules for the questionnaire form
     */
    protected function rules(): array
    {
        $rules = [
            'questionnaireForm.student_id' => ['required', 'string', 'exists:users,student_id'],
            'questionnaireForm.answers' => ['required', 'array', 'min:1'],
        ];

        // Add validation for each question
        foreach ($this->questions as $question) {
            $rules["questionnaireForm.answers.{$question->id}"] = ['required', 'min:1'];
        }

        return $rules;
    }

    /**
     * Custom validation messages
     */
    protected function messages(): array
    {
        $messages = [
            'questionnaireForm.student_id.required' => 'NIM wajib diisi.',
            'questionnaireForm.student_id.exists' => 'NIM tidak terdaftar dalam sistem.',
            'questionnaireForm.answers.required' => 'Harap jawab semua pertanyaan kuesioner.',
            'questionnaireForm.answers.min' => 'Harap jawab semua pertanyaan kuesioner.',
        ];

        // Add custom messages for each question
        foreach ($this->questions as $index => $question) {
            $questionNumber = $index + 1;
            $messages["questionnaireForm.answers.{$question->id}.required"] = "Pertanyaan #{$questionNumber} wajib dijawab.";
            $messages["questionnaireForm.answers.{$question->id}.min"] = "Jawaban pertanyaan #{$questionNumber} minimal 1.";
        }

        return $messages;
    }

    /**
     * Check if user has already submitted questionnaire for this facility
     */
    public function hasAlreadySubmitted(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $userId = Auth::id();
        $questionIds = $this->questions->pluck('id')->toArray();

        return Answer::where('user_id', $userId)
            ->whereIn('question_id', $questionIds)
            ->exists();
    }

    /**
     * Save questionnaire answers to database
     */
    public function createNewQuestionnaire()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu untuk mengisi kuesioner.');
            return;
        }

        // Check if already submitted
        if ($this->hasAlreadySubmitted()) {
            session()->flash('error', 'Anda sudah pernah mengisi kuesioner untuk fasilitas ini.');
            $this->resetForm();
            return;
        }

        // Validate all answers
        $this->validate();

        // Verify all questions are answered
        $questionIds = $this->questions->pluck('id')->toArray();
        $answeredIds = array_keys($this->questionnaireForm['answers']);

        if (count(array_diff($questionIds, $answeredIds)) > 0) {
            session()->flash('error', 'Harap jawab semua pertanyaan sebelum mengirim.');
            return;
        }

        try {
            DB::beginTransaction();

            $userId = Auth::id();
            $periodId = $this->periods->id;

            foreach ($this->questionnaireForm['answers'] as $questionId => $rating) {
                Answer::create([
                    'user_id' => $userId,
                    'period_id' => $periodId,
                    'question_id' => $questionId,
                    'content' => $rating,
                ]);
            }

            DB::commit();

            // Reset form after successful submission
            $this->resetForm();

            // Flash success message
            session()->flash('success', 'Terima kasih! Kuesioner Anda berhasil dikirim.');

            // Dispatch browser event to close modal
            $this->dispatch('close-modal', modal: 'questionnaireModal');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan saat menyimpan kuesioner. Silakan coba lagi.');

            // Log error for debugging
            Log::error('Failed to save questionnaire', [
                'user_id' => Auth::id(),
                'facility_id' => $this->facility->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Reset the form to initial state
     */
    public function resetForm()
    {
        $this->questionnaireForm['answers'] = [];

        if (Auth::check()) {
            $this->questionnaireForm['student_id'] = Auth::user()->student_id ?? '';
        }

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.facility.show');
    }
}
