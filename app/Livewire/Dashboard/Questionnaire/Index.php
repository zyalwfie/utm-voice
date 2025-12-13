<?php

namespace App\Livewire\Dashboard\Questionnaire;

use App\Models\Answer;
use App\Models\Facility;
use App\Models\Question;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public string $activeTab = 'overview';

    public function render()
    {
        return view('livewire.dashboard.questionnaire.index');
    }

    /**
     * Extract numeric rating from answer content
     * Format: "4 (Puas)" -> 4
     */
    private function extractRating($content): ?int
    {
        if (preg_match('/^(\d+)/', $content, $matches)) {
            return (int) $matches[1];
        }
        return null;
    }

    /**
     * Get rating label based on average score
     */
    private function getRatingLabel(float $avgRating): array
    {
        if ($avgRating >= 4.5) {
            return [
                'label' => 'Sangat Baik',
                'color' => 'green',
                'description' => 'Fasilitas dalam kondisi sangat baik dan sangat memuaskan pengguna.',
            ];
        } elseif ($avgRating >= 3.5) {
            return [
                'label' => 'Baik',
                'color' => 'blue',
                'description' => 'Fasilitas dalam kondisi baik dan memuaskan pengguna.',
            ];
        } elseif ($avgRating >= 2.5) {
            return [
                'label' => 'Cukup',
                'color' => 'yellow',
                'description' => 'Fasilitas dalam kondisi cukup, perlu beberapa perbaikan.',
            ];
        } elseif ($avgRating >= 1.5) {
            return [
                'label' => 'Kurang',
                'color' => 'orange',
                'description' => 'Fasilitas kurang memuaskan, perlu perbaikan segera.',
            ];
        } else {
            return [
                'label' => 'Sangat Kurang',
                'color' => 'red',
                'description' => 'Fasilitas sangat tidak memuaskan, perlu perhatian serius.',
            ];
        }
    }

    #[Computed]
    public function facilities()
    {
        return Facility::orderBy('name')->get();
    }

    #[Computed]
    public function facilitiesWithStats()
    {
        return Facility::with(['questions' => function ($query) {
            $query->withCount('answers')->with('answers');
        }])
            ->whereHas('questions')
            ->orderBy('name')
            ->get()
            ->map(function ($facility) {
                $totalAnswers = 0;
                $totalRatingSum = 0;
                $ratingCount = 0;

                foreach ($facility->questions as $question) {
                    $totalAnswers += $question->answers_count;

                    foreach ($question->answers as $answer) {
                        $rating = $this->extractRating($answer->content);
                        if ($rating !== null) {
                            $totalRatingSum += $rating;
                            $ratingCount++;
                        }
                    }
                }

                $avgRating = $ratingCount > 0 ? round($totalRatingSum / $ratingCount, 2) : 0;
                $ratingInfo = $this->getRatingLabel($avgRating);

                $facility->total_answers = $totalAnswers;
                $facility->questions_count = $facility->questions->count();
                $facility->avg_rating = $avgRating;
                $facility->rating_label = $ratingInfo['label'];
                $facility->rating_color = $ratingInfo['color'];
                $facility->rating_description = $ratingInfo['description'];

                return $facility;
            });
    }

    #[Computed]
    public function overviewStats()
    {
        $totalFacilities = Facility::whereHas('questions')->count();
        $totalQuestions = Question::count();
        $totalAnswers = Answer::count();

        // Calculate overall average rating
        $allAnswers = Answer::all();
        $totalRatingSum = 0;
        $ratingCount = 0;

        foreach ($allAnswers as $answer) {
            $rating = $this->extractRating($answer->content);
            if ($rating !== null) {
                $totalRatingSum += $rating;
                $ratingCount++;
            }
        }

        $overallAvgRating = $ratingCount > 0 ? round($totalRatingSum / $ratingCount, 2) : 0;
        $overallRatingInfo = $this->getRatingLabel($overallAvgRating);

        // Rating distribution
        $ratingDistribution = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];

        foreach ($allAnswers as $answer) {
            $rating = $this->extractRating($answer->content);
            if ($rating !== null && isset($ratingDistribution[$rating])) {
                $ratingDistribution[$rating]++;
            }
        }

        return [
            'totalFacilities' => $totalFacilities,
            'totalQuestions' => $totalQuestions,
            'totalAnswers' => $totalAnswers,
            'totalResponden' => $ratingCount,
            'overallAvgRating' => $overallAvgRating,
            'overallRatingLabel' => $overallRatingInfo['label'],
            'overallRatingColor' => $overallRatingInfo['color'],
            'overallRatingDescription' => $overallRatingInfo['description'],
            'ratingDistribution' => $ratingDistribution,
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

        $totalAnswers = 0;
        $totalRatingSum = 0;
        $ratingCount = 0;

        foreach ($facility->questions as $question) {
            $totalAnswers += $question->answers_count;
            $questionRatingSum = 0;
            $questionRatingCount = 0;

            foreach ($question->answers as $answer) {
                $rating = $this->extractRating($answer->content);
                if ($rating !== null) {
                    $totalRatingSum += $rating;
                    $ratingCount++;
                    $questionRatingSum += $rating;
                    $questionRatingCount++;
                }
            }

            $questionAvgRating = $questionRatingCount > 0 ? round($questionRatingSum / $questionRatingCount, 2) : 0;
            $question->avg_rating = $questionAvgRating;
            $question->rating_info = $this->getRatingLabel($questionAvgRating);
        }

        $avgRating = $ratingCount > 0 ? round($totalRatingSum / $ratingCount, 2) : 0;
        $ratingInfo = $this->getRatingLabel($avgRating);

        return [
            'facility' => $facility,
            'totalQuestions' => $facility->questions->count(),
            'totalAnswers' => $totalAnswers,
            'totalResponden' => $ratingCount,
            'avgRating' => $avgRating,
            'ratingLabel' => $ratingInfo['label'],
            'ratingColor' => $ratingInfo['color'],
            'ratingDescription' => $ratingInfo['description'],
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
        $facilitiesData = $this->facilitiesWithStats;

        return [
            'facilityLabels' => $facilitiesData->pluck('name')->toArray(),
            'avgRatings' => $facilitiesData->pluck('avg_rating')->toArray(),
            'ratingLabels' => $facilitiesData->pluck('rating_label')->toArray(),
            'ratingColors' => $facilitiesData->map(function ($f) {
                return match ($f->rating_color) {
                    'green' => 'rgba(34, 197, 94, 0.8)',
                    'blue' => 'rgba(59, 130, 246, 0.8)',
                    'yellow' => 'rgba(234, 179, 8, 0.8)',
                    'orange' => 'rgba(249, 115, 22, 0.8)',
                    'red' => 'rgba(239, 68, 68, 0.8)',
                    default => 'rgba(156, 163, 175, 0.8)',
                };
            })->toArray(),
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

    public function generateSummary($facilityId = null)
    {
        if ($facilityId) {
            $facilityData = $this->facilitiesWithStats->firstWhere('id', $facilityId);

            if (!$facilityData) {
                return 'Data tidak ditemukan.';
            }

            $summary = "Fasilitas {$facilityData->name} mendapatkan rata-rata rating ";
            $summary .= "<strong>{$facilityData->avg_rating}/5.0</strong> dengan status ";
            $summary .= "<strong class=\"text-{$facilityData->rating_color}-600\">{$facilityData->rating_label}</strong>. ";
            $summary .= $facilityData->rating_description;
            $summary .= " Berdasarkan {$facilityData->total_answers} responden.";

            return $summary;
        }

        // Overall summary
        $stats = $this->overviewStats;
        $summary = "Secara keseluruhan, semua fasilitas mendapatkan rata-rata rating ";
        $summary .= "<strong>{$stats['overallAvgRating']}/5.0</strong> dengan status ";
        $summary .= "<strong class=\"text-{$stats['overallRatingColor']}-600\">{$stats['overallRatingLabel']}</strong>. ";
        $summary .= $stats['overallRatingDescription'];
        $summary .= " Data ini berdasarkan {$stats['totalResponden']} responden dari {$stats['totalFacilities']} fasilitas.";

        return $summary;
    }

    public function downloadPdf($type = 'all', $facilityId = null)
    {
        $data = [];

        if ($type === 'all') {
            $stats = $this->overviewStats;
            $facilitiesData = $this->facilitiesWithStats;

            $data = [
                'title' => 'Laporan Kuesioner Semua Fasilitas',
                'generatedAt' => now()->format('d M Y H:i'),
                'stats' => $stats,
                'facilities' => $facilitiesData->map(function ($facility) {
                    return [
                        'name' => $facility->name,
                        'questions_count' => $facility->questions_count,
                        'total_answers' => $facility->total_answers,
                        'avg_rating' => $facility->avg_rating,
                        'rating_label' => $facility->rating_label,
                        'rating_color' => $facility->rating_color,
                        'rating_description' => $facility->rating_description,
                        'questions' => $facility->questions->map(function ($question) {
                            $ratingSum = 0;
                            $ratingCount = 0;

                            foreach ($question->answers as $answer) {
                                if (preg_match('/^(\d+)/', $answer->content, $matches)) {
                                    $ratingSum += (int) $matches[1];
                                    $ratingCount++;
                                }
                            }

                            $avgRating = $ratingCount > 0 ? round($ratingSum / $ratingCount, 2) : 0;

                            return [
                                'content' => $question->content,
                                'answers_count' => $question->answers_count,
                                'avg_rating' => $avgRating,
                                'answers' => $question->answers->map(function ($answer) {
                                    return [
                                        'user_name' => $answer->user->name ?? 'Anonim',
                                        'content' => $answer->content,
                                        'created_at' => $answer->created_at->format('d M Y'),
                                    ];
                                }),
                            ];
                        }),
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

            $totalRatingSum = 0;
            $totalRatingCount = 0;

            $questionsData = $facility->questions->map(function ($question) use (&$totalRatingSum, &$totalRatingCount) {
                $ratingSum = 0;
                $ratingCount = 0;

                foreach ($question->answers as $answer) {
                    if (preg_match('/^(\d+)/', $answer->content, $matches)) {
                        $rating = (int) $matches[1];
                        $ratingSum += $rating;
                        $ratingCount++;
                        $totalRatingSum += $rating;
                        $totalRatingCount++;
                    }
                }

                $avgRating = $ratingCount > 0 ? round($ratingSum / $ratingCount, 2) : 0;

                return [
                    'content' => $question->content,
                    'answers_count' => $question->answers_count,
                    'avg_rating' => $avgRating,
                    'answers' => $question->answers->map(function ($answer) {
                        return [
                            'user_name' => $answer->user->name ?? 'Anonim',
                            'content' => $answer->content,
                            'created_at' => $answer->created_at->format('d M Y'),
                        ];
                    }),
                ];
            });

            $avgRating = $totalRatingCount > 0 ? round($totalRatingSum / $totalRatingCount, 2) : 0;
            $ratingInfo = $this->getRatingLabel($avgRating);

            $data = [
                'title' => 'Laporan Kuesioner: ' . $facility->name,
                'generatedAt' => now()->format('d M Y H:i'),
                'facility' => [
                    'name' => $facility->name,
                    'description' => $facility->description,
                    'total_questions' => $facility->questions->count(),
                    'total_answers' => $facility->questions->sum('answers_count'),
                    'avg_rating' => $avgRating,
                    'rating_label' => $ratingInfo['label'],
                    'rating_color' => $ratingInfo['color'],
                    'rating_description' => $ratingInfo['description'],
                    'questions' => $questionsData,
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
}
