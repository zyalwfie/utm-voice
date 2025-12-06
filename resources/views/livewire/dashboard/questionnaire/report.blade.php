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

        .summary-box h3 {
            color: #1e40af;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .summary-box p {
            color: #3730a3;
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

        .page-break {
            page-break-after: always;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f3f4f6;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            color: #6b7280;
        }

        td {
            font-size: 11px;
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

        .badge-green {
            background-color: #d1fae5;
            color: #065f46;
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
                    <div class="stat-value">{{ $stats['totalQuestions'] }}</div>
                    <div class="stat-label">Total Kuesioner</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $stats['totalAnswers'] }}</div>
                    <div class="stat-label">Total Jawaban</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $stats['avgAnswersPerQuestion'] }}</div>
                    <div class="stat-label">Rata-rata Jawaban</div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="summary-box">
            <h3>Ringkasan Keseluruhan</h3>
            <p>
                Laporan ini mencakup {{ $stats['totalFacilities'] }} fasilitas dengan total
                {{ $stats['totalQuestions'] }} kuesioner dan {{ $stats['totalAnswers'] }} jawaban.
                Rata-rata setiap pertanyaan kuesioner dijawab oleh {{ $stats['avgAnswersPerQuestion'] }} responden.
                @if ($stats['avgAnswersPerQuestion'] < 5)
                    Partisipasi responden masih perlu ditingkatkan untuk mendapatkan data yang lebih komprehensif.
                @elseif($stats['avgAnswersPerQuestion'] < 15)
                    Partisipasi responden sudah cukup baik, namun masih dapat ditingkatkan.
                @else
                    Partisipasi responden sangat baik dan data yang dikumpulkan sudah cukup representatif.
                @endif
            </p>
        </div>

        <!-- Facilities -->
        @foreach ($facilities as $facility)
            <div class="facility-section">
                <div class="facility-header">
                    <h2>{{ $facility['name'] }}</h2>
                    <div class="facility-stats">
                        {{ $facility['questions_count'] }} Kuesioner &bull; {{ $facility['total_answers'] }} Jawaban
                    </div>
                </div>
                <div class="facility-content">
                    @forelse ($facility['questions'] as $question)
                        <div class="question-item">
                            <div class="question-text">{{ $question['content'] }}</div>
                            <div class="question-meta">
                                <span class="badge badge-blue">{{ $question['answers_count'] }} jawaban</span>
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
                    <div class="stat-value">
                        {{ $facility['total_questions'] > 0 ? round($facility['total_answers'] / $facility['total_questions'], 1) : 0 }}
                    </div>
                    <div class="stat-label">Rata-rata Jawaban</div>
                </div>
            </div>
        </div>

        @if ($facility['description'])
            <div class="summary-box">
                <h3>Deskripsi Fasilitas</h3>
                <p>{{ $facility['description'] }}</p>
            </div>
        @endif

        <div class="summary-box">
            <h3>Ringkasan</h3>
            <p>
                Fasilitas {{ $facility['name'] }} memiliki {{ $facility['total_questions'] }} pertanyaan kuesioner
                dengan total {{ $facility['total_answers'] }} jawaban dari mahasiswa.
                @php
                    $avg =
                        $facility['total_questions'] > 0
                            ? round($facility['total_answers'] / $facility['total_questions'], 1)
                            : 0;
                @endphp
                @if ($avg < 5)
                    Partisipasi responden masih perlu ditingkatkan.
                @elseif($avg < 15)
                    Partisipasi responden sudah cukup baik.
                @else
                    Partisipasi responden sangat baik.
                @endif
            </p>
        </div>

        <h3 style="margin-bottom: 15px; color: #1f2937; font-size: 16px;">Daftar Kuesioner & Jawaban</h3>

        @foreach ($facility['questions'] as $question)
            <div class="question-item"
                style="margin-bottom: 20px; padding: 15px; background: #f9fafb; border-radius: 8px;">
                <div class="question-text">{{ $question['content'] }}</div>
                <div class="question-meta" style="margin-bottom: 10px;">
                    <span class="badge badge-blue">{{ $question['answers_count'] }} jawaban</span>
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
