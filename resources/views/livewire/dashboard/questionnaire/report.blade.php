<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #1f2937;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #3b82f6;
        }

        .header h1 {
            font-size: 24px;
            color: #1e40af;
            margin-bottom: 5px;
        }

        .header .subtitle {
            font-size: 12px;
            color: #6b7280;
        }

        .header .date {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 5px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .stats-row {
            display: table-row;
        }

        .stat-card {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .stat-card:first-child {
            border-radius: 8px 0 0 8px;
        }

        .stat-card:last-child {
            border-radius: 0 8px 8px 0;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #3b82f6;
        }

        .stat-value.green { color: #22c55e; }
        .stat-value.blue { color: #3b82f6; }
        .stat-value.yellow { color: #eab308; }
        .stat-value.orange { color: #f97316; }
        .stat-value.red { color: #ef4444; }

        .stat-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
        }

        .summary-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .summary-box.green { background-color: #f0fdf4; border-color: #bbf7d0; }
        .summary-box.blue { background-color: #eff6ff; border-color: #bfdbfe; }
        .summary-box.yellow { background-color: #fefce8; border-color: #fef08a; }
        .summary-box.orange { background-color: #fff7ed; border-color: #fed7aa; }
        .summary-box.red { background-color: #fef2f2; border-color: #fecaca; }

        .summary-box h3 {
            color: #1e40af;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .summary-box.green h3 { color: #15803d; }
        .summary-box.blue h3 { color: #1e40af; }
        .summary-box.yellow h3 { color: #a16207; }
        .summary-box.orange h3 { color: #c2410c; }
        .summary-box.red h3 { color: #b91c1c; }

        .summary-box p {
            color: #374151;
            font-size: 12px;
        }

        .facility-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .facility-header {
            background-color: #3b82f6;
            color: white;
            padding: 12px 15px;
            border-radius: 8px 8px 0 0;
        }

        .facility-header.green { background-color: #22c55e; }
        .facility-header.blue { background-color: #3b82f6; }
        .facility-header.yellow { background-color: #eab308; }
        .facility-header.orange { background-color: #f97316; }
        .facility-header.red { background-color: #ef4444; }

        .facility-header h2 {
            font-size: 16px;
            margin-bottom: 3px;
        }

        .facility-header .facility-stats {
            font-size: 11px;
            opacity: 0.9;
        }

        .facility-content {
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
            padding: 15px;
        }

        .rating-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .rating-badge.green { background-color: #dcfce7; color: #15803d; }
        .rating-badge.blue { background-color: #dbeafe; color: #1e40af; }
        .rating-badge.yellow { background-color: #fef9c3; color: #a16207; }
        .rating-badge.orange { background-color: #ffedd5; color: #c2410c; }
        .rating-badge.red { background-color: #fee2e2; color: #b91c1c; }

        .question-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f3f4f6;
        }

        .question-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .question-text {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .question-meta {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .answers-list {
            margin-left: 15px;
        }

        .answer-item {
            background-color: #f9fafb;
            border-left: 3px solid #10b981;
            padding: 8px 12px;
            margin-bottom: 8px;
            border-radius: 0 4px 4px 0;
        }

        .answer-content {
            font-size: 11px;
            color: #374151;
            margin-bottom: 3px;
        }

        .answer-meta {
            font-size: 9px;
            color: #9ca3af;
        }

        .no-answers {
            font-style: italic;
            color: #9ca3af;
            font-size: 11px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            padding: 10px;
            border-top: 1px solid #e5e7eb;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 500;
        }

        .badge-blue {
            background-color: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <p class="subtitle">Universitas Teknologi Mataram</p>
        <p class="date">Digenerate pada: {{ $generatedAt }}</p>
    </div>

    @if (isset($stats))
        <!-- Overall Stats -->
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-value">{{ $stats['totalFacilities'] }}</div>
                    <div class="stat-label">Fasilitas Aktif</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $stats['totalResponden'] }}</div>
                    <div class="stat-label">Total Jawaban</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value {{ $stats['overallRatingColor'] }}">{{ $stats['overallAvgRating'] }}/5.0</div>
                    <div class="stat-label">Rata-rata Rating</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value {{ $stats['overallRatingColor'] }}">{{ $stats['overallRatingLabel'] }}</div>
                    <div class="stat-label">Status</div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="summary-box {{ $stats['overallRatingColor'] }}">
            <h3>Kesimpulan Keseluruhan</h3>
            <p>
                Berdasarkan {{ $stats['totalResponden'] }} jawaban dari {{ $stats['totalFacilities'] }} fasilitas,
                rata-rata rating kepuasan adalah <strong>{{ $stats['overallAvgRating'] }}/5.0</strong>
                dengan status <strong>{{ $stats['overallRatingLabel'] }}</strong>.
                {{ $stats['overallRatingDescription'] }}
            </p>
        </div>

        <!-- Facilities -->
        @foreach ($facilities as $facility)
            <div class="facility-section">
                <div class="facility-header {{ $facility['rating_color'] }}">
                    <h2>{{ $facility['name'] }}</h2>
                    <div class="facility-stats">
                        Rating: {{ $facility['avg_rating'] }}/5.0 ({{ $facility['rating_label'] }}) &bull;
                        {{ $facility['questions_count'] }} Kuesioner &bull; {{ $facility['total_answers'] }} Responden
                    </div>
                </div>
                <div class="facility-content">
                    <div class="rating-badge {{ $facility['rating_color'] }}">
                        {{ $facility['rating_label'] }}: {{ $facility['rating_description'] }}
                    </div>

                    @forelse ($facility['questions'] as $question)
                        <div class="question-item">
                            <div class="question-text">{{ $question['content'] }}</div>
                            <div class="question-meta">
                                <span class="badge badge-blue">{{ $question['answers_count'] }} jawaban</span>
                                @if($question['avg_rating'] > 0)
                                    &bull; Rating: {{ $question['avg_rating'] }}/5.0
                                @endif
                            </div>

                            @if (count($question['answers']) > 0)
                                <div class="answers-list">
                                    @foreach ($question['answers']->take(5) as $answer)
                                        <div class="answer-item">
                                            <div class="answer-content">{{ $answer['content'] }}</div>
                                            <div class="answer-meta">
                                                {{ $answer['user_name'] }} - {{ $answer['created_at'] }}
                                            </div>
                                        </div>
                                    @endforeach
                                    @if (count($question['answers']) > 5)
                                        <p class="no-answers">
                                            ... dan {{ count($question['answers']) - 5 }} jawaban lainnya
                                        </p>
                                    @endif
                                </div>
                            @else
                                <p class="no-answers">Belum ada jawaban untuk kuesioner ini.</p>
                            @endif
                        </div>
                    @empty
                        <p class="no-answers">Tidak ada kuesioner untuk fasilitas ini.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    @elseif(isset($facility))
        <!-- Single Facility Report -->
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-value">{{ $facility['total_questions'] }}</div>
                    <div class="stat-label">Total Kuesioner</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $facility['total_answers'] }}</div>
                    <div class="stat-label">Total Jawaban</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value {{ $facility['rating_color'] }}">{{ $facility['avg_rating'] }}/5.0</div>
                    <div class="stat-label">Rata-rata Rating</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value {{ $facility['rating_color'] }}">{{ $facility['rating_label'] }}</div>
                    <div class="stat-label">Status</div>
                </div>
            </div>
        </div>

        @if ($facility['description'])
            <div class="summary-box">
                <h3>Deskripsi Fasilitas</h3>
                <p>{{ $facility['description'] }}</p>
            </div>
        @endif

        <div class="summary-box {{ $facility['rating_color'] }}">
            <h3>Kesimpulan</h3>
            <p>
                Fasilitas {{ $facility['name'] }} mendapatkan rata-rata rating
                <strong>{{ $facility['avg_rating'] }}/5.0</strong> dengan status
                <strong>{{ $facility['rating_label'] }}</strong>.
                {{ $facility['rating_description'] }}
                Data ini berdasarkan {{ $facility['total_answers'] }} jawaban.
            </p>
        </div>

        <h3 style="margin-bottom: 15px; color: #1f2937; font-size: 16px;">Daftar Kuesioner & Jawaban</h3>

        @foreach ($facility['questions'] as $question)
            <div class="question-item" style="margin-bottom: 20px; padding: 15px; background: #f9fafb; border-radius: 8px;">
                <div class="question-text">{{ $question['content'] }}</div>
                <div class="question-meta" style="margin-bottom: 10px;">
                    <span class="badge badge-blue">{{ $question['answers_count'] }} jawaban</span>
                    @if($question['avg_rating'] > 0)
                        &bull; Rating: {{ $question['avg_rating'] }}/5.0
                    @endif
                </div>

                @if (count($question['answers']) > 0)
                    <div class="answers-list">
                        @foreach ($question['answers'] as $answer)
                            <div class="answer-item">
                                <div class="answer-content">{{ $answer['content'] }}</div>
                                <div class="answer-meta">
                                    {{ $answer['user_name'] }} - {{ $answer['created_at'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-answers">Belum ada jawaban untuk kuesioner ini.</p>
                @endif
            </div>
        @endforeach
    @endif

    <div class="footer">
        <p>Laporan Kuesioner - Universitas Teknologi Mataram | {{ $generatedAt }}</p>
    </div>
</body>

</html>
