<?php

namespace App\Livewire\Dashboard\Questionnaire;

use App\Models\Answer;
use App\Models\Facility;
use App\Models\Question;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Dasbor | Kuesioner')]
#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    // Modal states
    public bool $showCreateModal = false;
    public bool $showUpdateModal = false;
    public bool $showDeleteModal = false;
    public bool $showAnswersModal = false;
    public bool $showFacilityDetailModal = false;

    // Form fields
    public $facilityId = '';
    public $question = '';
    public $selectedQuestionId = null;
    public $selectedFacilityId = null;

    // Filters
    public string $query = '';
    public string $sortKey = '';
    public string $activeTab = 'overview'; // overview, facilities, questions

    public function render()
    {
        return view('livewire.dashboard.questionnaire.index');
    }

    #[Computed]
    public function facilities()
    {
        return Facility::orderBy('name')->get();
    }

    #[Computed]
    public function facilitiesWithStats()
    {
        return Facility::withCount(['questions', 'questions as total_answers_count' => function ($query) {
            $query->select(DB::raw('COALESCE(SUM((SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.id)), 0)'));
        }])
            ->with(['questions' => function ($query) {
                $query->withCount('answers');
            }])
            ->having('questions_count', '>', 0)
            ->orderBy('name')
            ->get()
            ->map(function ($facility) {
                $totalAnswers = $facility->questions->sum('answers_count');
                $facility->total_answers = $totalAnswers;
                $facility->avg_answers_per_question = $facility->questions_count > 0
                    ? round($totalAnswers / $facility->questions_count, 1)
                    : 0;
                return $facility;
            });
    }

    #[Computed]
    public function overviewStats()
    {
        $totalFacilities = Facility::whereHas('questions')->count();
        $totalQuestions = Question::count();
        $totalAnswers = Answer::count();
        $facilitiesWithoutQuestions = Facility::whereDoesntHave('questions')->count();

        // Answers per month for the last 6 months
        $answersPerMonth = Answer::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Top facilities by answer count
        $topFacilities = Facility::withCount(['questions as answers_count' => function ($query) {
            $query->join('answers', 'questions.id', '=', 'answers.question_id')
                ->select(DB::raw('COUNT(answers.id)'));
        }])
            ->having('answers_count', '>', 0)
            ->orderByDesc('answers_count')
            ->limit(5)
            ->get();

        // Questions distribution by facility
        $questionsDistribution = Facility::withCount('questions')
            ->having('questions_count', '>', 0)
            ->orderByDesc('questions_count')
            ->get();

        return [
            'totalFacilities' => $totalFacilities,
            'totalQuestions' => $totalQuestions,
            'totalAnswers' => $totalAnswers,
            'facilitiesWithoutQuestions' => $facilitiesWithoutQuestions,
            'answersPerMonth' => $answersPerMonth,
            'topFacilities' => $topFacilities,
            'questionsDistribution' => $questionsDistribution,
            'avgAnswersPerQuestion' => $totalQuestions > 0 ? round($totalAnswers / $totalQuestions, 1) : 0,
        ];
    }

    #[Computed]
    public function questions()
    {
        $query = Question::with(['facility', 'answers.user'])
            ->withCount('answers');

        if ($this->query) {
            $query->where(function ($q) {
                $q->where('content', 'like', '%' . $this->query . '%')
                    ->orWhereHas('facility', function ($facilityQuery) {
                        $facilityQuery->where('name', 'like', '%' . $this->query . '%');
                    });
            });
        }

        if ($this->sortKey === 'facility') {
            $query->join('facilities', 'questions.facility_id', '=', 'facilities.id')
                ->orderBy('facilities.name')
                ->select('questions.*');
        } elseif ($this->sortKey === 'answers_count') {
            $query->orderByDesc('answers_count');
        } elseif ($this->sortKey === 'created_at') {
            $query->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        return $query->paginate(10);
    }

    #[Computed]
    public function selectedFacilityData()
    {
        if (!$this->selectedFacilityId) {
            return null;
        }

        $facility = Facility::with(['questions' => function ($query) {
            $query->withCount('answers')->with(['answers.user']);
        }])->find($this->selectedFacilityId);

        if (!$facility) {
            return null;
        }

        $totalAnswers = $facility->questions->sum('answers_count');
        $questionsWithAnswers = $facility->questions->filter(fn($q) => $q->answers_count > 0)->count();

        return [
            'facility' => $facility,
            'totalQuestions' => $facility->questions->count(),
            'totalAnswers' => $totalAnswers,
            'questionsWithAnswers' => $questionsWithAnswers,
            'avgAnswersPerQuestion' => $facility->questions->count() > 0
                ? round($totalAnswers / $facility->questions->count(), 1)
                : 0,
        ];
    }

    #[Computed]
    public function selectedQuestionAnswers()
    {
        if (!$this->selectedQuestionId) {
            return collect();
        }

        return Answer::with('user')
            ->where('question_id', $this->selectedQuestionId)
            ->latest()
            ->get();
    }

    #[Computed]
    public function chartData()
    {
        // Data for charts
        $facilitiesData = $this->facilitiesWithStats;

        return [
            'facilityLabels' => $facilitiesData->pluck('name')->toArray(),
            'questionCounts' => $facilitiesData->pluck('questions_count')->toArray(),
            'answerCounts' => $facilitiesData->pluck('total_answers')->toArray(),
        ];
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function openFacilityDetail($facilityId)
    {
        $this->selectedFacilityId = $facilityId;
        $this->showFacilityDetailModal = true;
    }

    public function closeFacilityDetailModal()
    {
        $this->showFacilityDetailModal = false;
        $this->selectedFacilityId = null;
    }

    public function openCreateModal()
    {
        $this->reset(['facilityId', 'question']);
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->reset(['facilityId', 'question']);
    }

    public function openUpdateModal($id)
    {
        $question = Question::find($id);
        if ($question) {
            $this->selectedQuestionId = $id;
            $this->facilityId = $question->facility_id;
            $this->question = $question->content;
            $this->showUpdateModal = true;
        }
    }

    public function closeUpdateModal()
    {
        $this->showUpdateModal = false;
        $this->reset(['selectedQuestionId', 'facilityId', 'question']);
    }

    public function openDeleteModal($id)
    {
        $this->selectedQuestionId = $id;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedQuestionId = null;
    }

    public function openAnswersModal($id)
    {
        $this->selectedQuestionId = $id;
        $this->showAnswersModal = true;
    }

    public function closeAnswersModal()
    {
        $this->showAnswersModal = false;
        $this->selectedQuestionId = null;
    }

    public function createNewQuestion()
    {
        $this->validate([
            'facilityId' => 'required|exists:facilities,id',
            'question' => 'required|string|min:10',
        ], [
            'facilityId.required' => 'Pilih fasilitas terlebih dahulu.',
            'facilityId.exists' => 'Fasilitas tidak valid.',
            'question.required' => 'Pertanyaan wajib diisi.',
            'question.min' => 'Pertanyaan minimal 10 karakter.',
        ]);

        Question::create([
            'facility_id' => $this->facilityId,
            'content' => $this->question,
        ]);

        $this->closeCreateModal();
        session()->flash('success', 'Kuesioner berhasil ditambahkan.');
    }

    public function updateQuestion()
    {
        $this->validate([
            'facilityId' => 'required|exists:facilities,id',
            'question' => 'required|string|min:10',
        ]);

        $question = Question::find($this->selectedQuestionId);
        if ($question) {
            $question->update([
                'facility_id' => $this->facilityId,
                'content' => $this->question,
            ]);
        }

        $this->closeUpdateModal();
        session()->flash('success', 'Kuesioner berhasil diperbarui.');
    }

    public function deleteQuestion()
    {
        $question = Question::find($this->selectedQuestionId);
        if ($question) {
            $question->answers()->delete();
            $question->delete();
        }

        $this->closeDeleteModal();
        session()->flash('success', 'Kuesioner berhasil dihapus.');
    }

    public function downloadPdf($type = 'all', $facilityId = null)
    {
        $data = [];

        if ($type === 'all') {
            $data = [
                'title' => 'Laporan Kuesioner Semua Fasilitas',
                'generatedAt' => now()->format('d M Y H:i'),
                'stats' => $this->overviewStats,
                'facilities' => $this->facilitiesWithStats->map(function ($facility) {
                    return [
                        'name' => $facility->name,
                        'questions' => $facility->questions->map(function ($question) {
                            return [
                                'content' => $question->content,
                                'answers_count' => $question->answers_count,
                                'answers' => $question->answers->map(function ($answer) {
                                    return [
                                        'user_name' => $answer->user->name ?? 'Anonim',
                                        'content' => $answer->content,
                                        'created_at' => $answer->created_at->format('d M Y'),
                                    ];
                                }),
                            ];
                        }),
                        'total_answers' => $facility->total_answers,
                        'questions_count' => $facility->questions_count,
                    ];
                }),
            ];
        } elseif ($type === 'facility' && $facilityId) {
            $facility = Facility::with(['questions' => function ($query) {
                $query->withCount('answers')->with(['answers.user']);
            }])->find($facilityId);

            if (!$facility) {
                return;
            }

            $data = [
                'title' => 'Laporan Kuesioner: ' . $facility->name,
                'generatedAt' => now()->format('d M Y H:i'),
                'facility' => [
                    'name' => $facility->name,
                    'description' => $facility->description,
                    'questions' => $facility->questions->map(function ($question) {
                        return [
                            'content' => $question->content,
                            'answers_count' => $question->answers_count,
                            'answers' => $question->answers->map(function ($answer) {
                                return [
                                    'user_name' => $answer->user->name ?? 'Anonim',
                                    'content' => $answer->content,
                                    'created_at' => $answer->created_at->format('d M Y'),
                                ];
                            }),
                        ];
                    }),
                    'total_questions' => $facility->questions->count(),
                    'total_answers' => $facility->questions->sum('answers_count'),
                ],
            ];
        }

        $pdf = Pdf::loadView('livewire.dashboard.questionnaire.report', $data);
        $filename = $type === 'all'
            ? 'laporan-kuesioner-semua-fasilitas-' . now()->format('Y-m-d') . '.pdf'
            : 'laporan-kuesioner-' . str()->slug($data['facility']['name'] ?? 'fasilitas') . '-' . now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function generateSummary($facilityId = null)
    {
        // Generate a simple summary based on answer statistics
        if ($facilityId) {
            $facility = Facility::with(['questions' => function ($query) {
                $query->withCount('answers');
            }])->find($facilityId);

            if (!$facility) {
                return 'Data tidak ditemukan.';
            }

            $totalQuestions = $facility->questions->count();
            $totalAnswers = $facility->questions->sum('answers_count');
            $avgAnswers = $totalQuestions > 0 ? round($totalAnswers / $totalQuestions, 1) : 0;

            $summary = "Fasilitas {$facility->name} memiliki {$totalQuestions} pertanyaan kuesioner ";
            $summary .= "dengan total {$totalAnswers} jawaban. ";
            $summary .= "Rata-rata setiap pertanyaan dijawab oleh {$avgAnswers} responden. ";

            if ($avgAnswers < 5) {
                $summary .= "Partisipasi responden masih perlu ditingkatkan.";
            } elseif ($avgAnswers < 15) {
                $summary .= "Partisipasi responden cukup baik.";
            } else {
                $summary .= "Partisipasi responden sangat baik.";
            }

            return $summary;
        }

        // Overall summary
        $stats = $this->overviewStats;
        $summary = "Total terdapat {$stats['totalFacilities']} fasilitas dengan kuesioner aktif, ";
        $summary .= "{$stats['totalQuestions']} pertanyaan, dan {$stats['totalAnswers']} jawaban. ";
        $summary .= "Rata-rata setiap pertanyaan dijawab oleh {$stats['avgAnswersPerQuestion']} responden.";

        return $summary;
    }
}
