<main class="h-auto p-4 pt-17 md:ml-64">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen Kuesioner</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola dan analisis kuesioner untuk semua
                    fasilitas</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="button" wire:click="downloadPdf('all')"
                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download PDF
                </button>
                <button type="button" wire:click="openCreateModal"
                    class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex cursor-pointer items-center rounded-lg px-4 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4">
                    <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Kuesioner
                </button>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium">
            <li class="mr-2">
                <button wire:click="setActiveTab('overview')"
                    class="{{ $activeTab === 'overview' ? 'border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' }} inline-flex cursor-pointer items-center gap-2 rounded-t-lg border-b-2 p-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Ringkasan
                </button>
            </li>
            <li class="mr-2">
                <button wire:click="setActiveTab('facilities')"
                    class="{{ $activeTab === 'facilities' ? 'border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' }} inline-flex cursor-pointer items-center gap-2 rounded-t-lg border-b-2 p-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Per Fasilitas
                </button>
            </li>
            <li class="mr-2">
                <button wire:click="setActiveTab('questions')"
                    class="{{ $activeTab === 'questions' ? 'border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' }} inline-flex cursor-pointer items-center gap-2 rounded-t-lg border-b-2 p-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Semua Kuesioner
                </button>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Overview Tab -->
        @if ($activeTab === 'overview')
            <div class="space-y-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center">
                            <div class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Fasilitas Aktif</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $this->overviewStats['totalFacilities'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center">
                            <div class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900">
                                <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Total Kuesioner</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $this->overviewStats['totalQuestions'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center">
                            <div class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Total Jawaban</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $this->overviewStats['totalAnswers'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center">
                            <div class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-orange-100 dark:bg-orange-900">
                                <svg class="h-6 w-6 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Rata-rata Jawaban</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $this->overviewStats['avgAnswersPerQuestion'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Bar Chart - Questions & Answers per Facility -->
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kuesioner per Fasilitas</h3>
                        </div>
                        <div class="h-80">
                            <canvas id="facilityBarChart"></canvas>
                        </div>
                    </div>

                    <!-- Pie Chart - Distribution -->
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Jawaban</h3>
                        </div>
                        <div class="h-80">
                            <canvas id="answersPieChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-2">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ringkasan Keseluruhan</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">{{ $this->generateSummary() }}</p>
                </div>
            </div>
        @endif

        <!-- Facilities Tab -->
        @if ($activeTab === 'facilities')
            <div class="space-y-4">
                @forelse ($this->facilitiesWithStats as $facility)
                    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <!-- Facility Header -->
                        <div class="flex flex-col gap-4 border-b border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900">
                                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $facility->name }}</h3>
                                    <div class="mt-1 flex flex-wrap gap-3 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $facility->questions_count }} kuesioner
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                            </svg>
                                            {{ $facility->total_answers }} jawaban
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            Avg: {{ $facility->avg_answers_per_question }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="downloadPdf('facility', {{ $facility->id }})"
                                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    PDF
                                </button>
                                <button wire:click="openFacilityDetail({{ $facility->id }})"
                                    class="bg-primary-700 hover:bg-primary-800 dark:bg-primary-600 dark:hover:bg-primary-700 inline-flex cursor-pointer items-center rounded-lg px-3 py-2 text-sm font-medium text-white">
                                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </button>
                            </div>
                        </div>

                        <!-- Questions List -->
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($facility->questions as $question)
                                <div class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <div class="flex-1 pr-4">
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $question->content }}</p>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $question->answers_count }} jawaban
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if ($question->answers_count > 0)
                                            <button wire:click="openAnswersModal({{ $question->id }})"
                                                class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        @endif
                                        <button wire:click="openUpdateModal({{ $question->id }})"
                                            class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button wire:click="openDeleteModal({{ $question->id }})"
                                            class="cursor-pointer rounded-lg p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Facility Summary -->
                        <div class="border-t border-gray-200 bg-blue-50 p-4 dark:border-gray-700 dark:bg-blue-900/20">
                            <p class="text-sm text-blue-800 dark:text-blue-300">
                                <strong>Kesimpulan:</strong> {{ $this->generateSummary($facility->id) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border border-gray-200 bg-white p-8 text-center dark:border-gray-700 dark:bg-gray-800">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Belum ada kuesioner</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai dengan menambahkan kuesioner untuk fasilitas.</p>
                        <button wire:click="openCreateModal"
                            class="bg-primary-700 hover:bg-primary-800 mt-4 inline-flex cursor-pointer items-center rounded-lg px-4 py-2 text-sm font-medium text-white">
                            <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Kuesioner
                        </button>
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Questions Tab (All Questions) -->
        @if ($activeTab === 'questions')
            <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <!-- Search and Filter -->
                <div class="flex flex-col gap-4 border-b border-gray-200 p-4 dark:border-gray-700 md:flex-row md:items-center md:justify-between">
                    <div class="w-full md:w-1/2">
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live="query" type="text"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                placeholder="Cari kuesioner...">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <select wire:model.live="sortKey"
                            class="rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            <option value="">Urutkan</option>
                            <option value="facility">Nama Fasilitas</option>
                            <option value="answers_count">Jumlah Jawaban</option>
                            <option value="created_at">Terbaru</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Fasilitas</th>
                                <th scope="col" class="px-4 py-3">Kuesioner</th>
                                <th scope="col" class="px-4 py-3">Jawaban</th>
                                <th scope="col" class="px-4 py-3">Dibuat</th>
                                <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($this->questions as $question)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                        {{ $question->facility->name }}
                                    </td>
                                    <td class="max-w-xs px-4 py-3">
                                        <div class="truncate" title="{{ $question->content }}">
                                            {{ $question->content }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ $question->answers_count }} jawaban
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $question->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-end gap-1">
                                            @if ($question->answers_count > 0)
                                                <button wire:click="openAnswersModal({{ $question->id }})"
                                                    class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600"
                                                    title="Lihat Jawaban">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            @endif
                                            <button wire:click="openUpdateModal({{ $question->id }})"
                                                class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600"
                                                title="Edit">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button wire:click="openDeleteModal({{ $question->id }})"
                                                class="cursor-pointer rounded-lg p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20"
                                                title="Hapus">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        Tidak ada kuesioner yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($this->questions->hasPages())
                    <div class="border-t border-gray-200 p-4 dark:border-gray-700">
                        {{ $this->questions->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Create Modal -->
    @if ($showCreateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative max-h-full w-full max-w-2xl p-4">
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Buat Kuesioner Baru</h3>
                        <button type="button" wire:click="closeCreateModal"
                            class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="createNewQuestion" class="p-4">
                        <div class="mb-4 flex flex-col gap-4">
                            <div>
                                <label for="facility" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pilih Fasilitas</label>
                                <select id="facility" wire:model="facilityId"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                    <option value="">Pilih fasilitas</option>
                                    @foreach ($this->facilities as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                                </select>
                                @error('facilityId')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="question" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pertanyaan Kuesioner</label>
                                <textarea id="question" rows="4" wire:model="question"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    placeholder="Tulis pertanyaan kuesioner di sini..."></textarea>
                                @error('question')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="-ms-1 me-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambahkan Kuesioner
                            <svg wire:loading wire:target="createNewQuestion" class="ml-2 inline h-4 w-4 animate-spin" viewBox="0 0 100 101" fill="none">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Update Modal -->
    @if ($showUpdateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative max-h-full w-full max-w-2xl p-4">
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Kuesioner</h3>
                        <button type="button" wire:click="closeUpdateModal"
                            class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateQuestion" class="p-4">
                        <div class="mb-4 flex flex-col gap-4">
                            <div>
                                <label for="facilityUpdate" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pilih Fasilitas</label>
                                <select id="facilityUpdate" wire:model="facilityId"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                    <option value="">Pilih fasilitas</option>
                                    @foreach ($this->facilities as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                                </select>
                                @error('facilityId')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="questionUpdate" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pertanyaan Kuesioner</label>
                                <textarea id="questionUpdate" rows="4" wire:model="question"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    placeholder="Tulis pertanyaan kuesioner di sini..."></textarea>
                                @error('question')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="-ms-1 me-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Perbarui Kuesioner
                            <svg wire:loading wire:target="updateQuestion" class="ml-2 inline h-4 w-4 animate-spin" viewBox="0 0 100 101" fill="none">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative max-h-full w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white p-4 text-center shadow dark:bg-gray-800 sm:p-5">
                    <button type="button" wire:click="closeDeleteModal"
                        class="absolute right-2.5 top-2.5 ml-auto inline-flex cursor-pointer items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <svg class="mx-auto mb-3.5 h-11 w-11 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda yakin ingin menghapus kuesioner ini? Semua jawaban akan ikut terhapus.</p>
                    <div class="flex items-center justify-center space-x-4">
                        <button wire:click="closeDeleteModal" type="button"
                            class="focus:ring-primary-300 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                            Tidak, batal
                        </button>
                        <button type="button" wire:click="deleteQuestion"
                            class="rounded-lg bg-red-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Ya, hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Answers Modal -->
    @if ($showAnswersModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative max-h-full w-full max-w-4xl p-4">
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                    <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Jawaban Kuesioner</h3>
                        <button type="button" wire:click="closeAnswersModal"
                            class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 md:p-5">
                        @if ($selectedQuestionId)
                            @php
                                $selectedQuestion = App\Models\Question::find($selectedQuestionId);
                            @endphp
                            @if ($selectedQuestion)
                                <div class="mb-4 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                                    <h4 class="mb-2 font-medium text-gray-900 dark:text-white">Pertanyaan:</h4>
                                    <p class="text-gray-700 dark:text-gray-300">{{ $selectedQuestion->content }}</p>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        <strong>Fasilitas:</strong> {{ $selectedQuestion->facility->name }}
                                    </p>
                                </div>
                            @endif
                        @endif

                        <div class="max-h-96 space-y-4 overflow-y-auto">
                            @forelse ($this->selectedQuestionAnswers as $answer)
                                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                                    <div class="mb-2 flex items-start justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                                                <span class="text-sm font-medium text-blue-600 dark:text-blue-300">
                                                    {{ substr($answer->user->name ?? 'A', 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $answer->user->name ?? 'Anonim' }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $answer->created_at->format('d M Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-gray-700 dark:text-gray-300">{{ $answer->content }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Belum ada jawaban untuk kuesioner ini.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Facility Detail Modal -->
    @if ($showFacilityDetailModal && $this->selectedFacilityData)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative max-h-[90vh] w-full max-w-5xl overflow-y-auto p-4">
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                    <div class="sticky top-0 z-10 flex items-center justify-between rounded-t border-b bg-white p-4 dark:border-gray-600 dark:bg-gray-800">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Detail: {{ $this->selectedFacilityData['facility']->name }}
                        </h3>
                        <button type="button" wire:click="closeFacilityDetailModal"
                            class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 md:p-5">
                        <!-- Facility Stats -->
                        <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-4">
                            <div class="rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                                <p class="text-sm text-blue-600 dark:text-blue-400">Total Kuesioner</p>
                                <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $this->selectedFacilityData['totalQuestions'] }}</p>
                            </div>
                            <div class="rounded-lg bg-green-50 p-4 dark:bg-green-900/20">
                                <p class="text-sm text-green-600 dark:text-green-400">Total Jawaban</p>
                                <p class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $this->selectedFacilityData['totalAnswers'] }}</p>
                            </div>
                            <div class="rounded-lg bg-purple-50 p-4 dark:bg-purple-900/20">
                                <p class="text-sm text-purple-600 dark:text-purple-400">Dengan Jawaban</p>
                                <p class="text-2xl font-bold text-purple-700 dark:text-purple-300">{{ $this->selectedFacilityData['questionsWithAnswers'] }}</p>
                            </div>
                            <div class="rounded-lg bg-orange-50 p-4 dark:bg-orange-900/20">
                                <p class="text-sm text-orange-600 dark:text-orange-400">Rata-rata</p>
                                <p class="text-2xl font-bold text-orange-700 dark:text-orange-300">{{ $this->selectedFacilityData['avgAnswersPerQuestion'] }}</p>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="mb-6 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                            <h4 class="mb-2 font-semibold text-blue-800 dark:text-blue-300">Kesimpulan</h4>
                            <p class="text-blue-700 dark:text-blue-400">{{ $this->generateSummary($selectedFacilityId) }}</p>
                        </div>

                        <!-- Questions List -->
                        <h4 class="mb-4 font-semibold text-gray-900 dark:text-white">Daftar Kuesioner</h4>
                        <div class="space-y-4">
                            @foreach ($this->selectedFacilityData['facility']->questions as $question)
                                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                                    <div class="mb-2 flex items-start justify-between">
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $question->content }}</p>
                                        <span class="ml-2 inline-flex flex-shrink-0 items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ $question->answers_count }} jawaban
                                        </span>
                                    </div>
                                    @if ($question->answers->count() > 0)
                                        <div class="mt-3 space-y-2">
                                            @foreach ($question->answers->take(3) as $answer)
                                                <div class="rounded bg-gray-50 p-2 dark:bg-gray-700">
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $answer->content }}</p>
                                                    <p class="mt-1 text-xs text-gray-400">- {{ $answer->user->name ?? 'Anonim' }}</p>
                                                </div>
                                            @endforeach
                                            @if ($question->answers->count() > 3)
                                                <button wire:click="openAnswersModal({{ $question->id }})"
                                                    class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                                                    Lihat {{ $question->answers->count() - 3 }} jawaban lainnya...
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        <p class="mt-2 text-sm text-gray-400">Belum ada jawaban</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</main>

@push('foot')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:navigated', initCharts);
        document.addEventListener('DOMContentLoaded', initCharts);

        function initCharts() {
            const barCtx = document.getElementById('facilityBarChart');
            const pieCtx = document.getElementById('answersPieChart');

            if (!barCtx || !pieCtx) return;

            // Destroy existing charts if they exist
            if (window.facilityBarChart instanceof Chart) {
                window.facilityBarChart.destroy();
            }
            if (window.answersPieChart instanceof Chart) {
                window.answersPieChart.destroy();
            }

            const chartData = @json($this->chartData);

            // Bar Chart
            window.facilityBarChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: chartData.facilityLabels,
                    datasets: [{
                            label: 'Kuesioner',
                            data: chartData.questionCounts,
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Jawaban',
                            data: chartData.answerCounts,
                            backgroundColor: 'rgba(16, 185, 129, 0.8)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Pie Chart
            const colors = [
                'rgba(59, 130, 246, 0.8)',
                'rgba(16, 185, 129, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(239, 68, 68, 0.8)',
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.8)',
                'rgba(20, 184, 166, 0.8)',
                'rgba(249, 115, 22, 0.8)',
            ];

            window.answersPieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: chartData.facilityLabels,
                    datasets: [{
                        data: chartData.answerCounts,
                        backgroundColor: colors.slice(0, chartData.facilityLabels.length),
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }
    </script>
@endpush
