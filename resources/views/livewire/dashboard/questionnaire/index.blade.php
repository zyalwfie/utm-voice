    <main class="h-auto p-4 pt-20 md:ml-64">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen Kuesioner</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Analisis kepuasan dan kualitas fasilitas
                        berdasarkan rating pengguna</p>
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
                <li class="mr-2">
                    <button wire:click="setActiveTab('periods')"
                        class="{{ $activeTab === 'periods' ? 'border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300' }} inline-flex cursor-pointer items-center gap-2 rounded-t-lg border-b-2 p-4">
                        <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        Periode
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
                        <!-- Total Fasilitas -->
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex items-center">
                                <div
                                    class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900">
                                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Fasilitas Aktif</p>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $this->overviewStats['totalFacilities'] }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Total Responden -->
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex items-center">
                                <div
                                    class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900">
                                    <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Total Jawaban</p>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $this->overviewStats['totalResponden'] }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Rata-rata Rating -->
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex items-center">
                                <div
                                    class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-{{ $this->overviewStats['overallRatingColor'] }}-100 dark:bg-{{ $this->overviewStats['overallRatingColor'] }}-900">
                                    <svg class="h-6 w-6 text-{{ $this->overviewStats['overallRatingColor'] }}-600 dark:text-{{ $this->overviewStats['overallRatingColor'] }}-300"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Rata-rata Rating
                                    </p>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $this->overviewStats['overallAvgRating'] }}/5.0</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Status Keseluruhan -->
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex items-center">
                                <div
                                    class="mr-4 inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-{{ $this->overviewStats['overallRatingColor'] }}-100 dark:bg-{{ $this->overviewStats['overallRatingColor'] }}-900">
                                    @if ($this->overviewStats['overallRatingColor'] === 'green')
                                        <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @elseif($this->overviewStats['overallRatingColor'] === 'blue')
                                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    @elseif($this->overviewStats['overallRatingColor'] === 'yellow')
                                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-300" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="h-6 w-6 text-{{ $this->overviewStats['overallRatingColor'] }}-600 dark:text-{{ $this->overviewStats['overallRatingColor'] }}-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                    <h3
                                        class="text-xl font-bold text-{{ $this->overviewStats['overallRatingColor'] }}-600 dark:text-{{ $this->overviewStats['overallRatingColor'] }}-400">
                                        {{ $this->overviewStats['overallRatingLabel'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Bar Chart - Rating per Facility -->
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rating Kepuasan per
                                    Fasilitas</h3>
                            </div>
                            <div class="h-80">
                                <canvas id="facilityRatingChart"></canvas>
                            </div>
                        </div>

                        <!-- Pie Chart - Rating Distribution -->
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Rating</h3>
                            </div>
                            <div class="h-80">
                                <canvas id="ratingDistributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Facility Rating Comparison -->
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="mb-4 flex items-center gap-2">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Perbandingan Kualitas Fasilitas
                            </h3>
                        </div>
                        <div class="space-y-4">
                            @forelse ($this->facilitiesWithStats as $facility)
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-32 flex-shrink-0 truncate text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $facility->name }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="h-4 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                                            <div class="h-4 rounded-full bg-{{ $facility->rating_color }}-500"
                                                style="width: {{ ($facility->avg_rating / 5) * 100 }}%"></div>
                                        </div>
                                    </div>
                                    <div class="w-20 flex-shrink-0 text-right">
                                        <span
                                            class="text-sm font-semibold text-gray-900 dark:text-white">{{ $facility->avg_rating }}/5.0</span>
                                    </div>
                                    <div class="w-28 flex-shrink-0">
                                        <span
                                            class="inline-flex items-center rounded-full bg-{{ $facility->rating_color }}-100 px-2.5 py-0.5 text-xs font-medium text-{{ $facility->rating_color }}-800 dark:bg-{{ $facility->rating_color }}-900 dark:text-{{ $facility->rating_color }}-300">
                                            {{ $facility->rating_label }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 dark:text-gray-300">Belum ada jawaban kuesioner dari mahasiswa.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="mb-4 flex items-center gap-2">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kesimpulan Keseluruhan</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">{!! $this->generateSummary() !!}</p>
                    </div>
                </div>
            @endif

            <!-- Facilities Tab -->
            @if ($activeTab === 'facilities')
                <div class="space-y-4">
                    @forelse ($this->facilitiesWithStats as $facility)
                        <div
                            class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <!-- Facility Header -->
                            <div
                                class="flex flex-col gap-4 border-b border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="inline-flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-lg bg-{{ $facility->rating_color }}-100 dark:bg-{{ $facility->rating_color }}-900">
                                        <span
                                            class="text-xl font-bold text-{{ $facility->rating_color }}-600 dark:text-{{ $facility->rating_color }}-300">{{ $facility->avg_rating }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $facility->name }}</h3>
                                        <div class="mt-1 flex flex-wrap items-center gap-3">
                                            <span
                                                class="inline-flex items-center rounded-full bg-{{ $facility->rating_color }}-100 px-2.5 py-0.5 text-xs font-medium text-{{ $facility->rating_color }}-800 dark:bg-{{ $facility->rating_color }}-900 dark:text-{{ $facility->rating_color }}-300">
                                                {{ $facility->rating_label }}
                                            </span>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $facility->questions_count }} kuesioner •
                                                {{ $facility->total_answers }} responden
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button wire:click="downloadPdf('facility', {{ $facility->id }})"
                                        class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        PDF
                                    </button>
                                    <button wire:click="openFacilityDetail({{ $facility->id }})"
                                        class="bg-primary-700 hover:bg-primary-800 dark:bg-primary-600 dark:hover:bg-primary-700 inline-flex cursor-pointer items-center rounded-lg px-3 py-2 text-sm font-medium text-white">
                                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </button>
                                </div>
                            </div>

                            <!-- Questions List -->
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($facility->questions as $question)
                                    <div
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <div class="flex-1 pr-4">
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $question->content }}</p>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                {{ $question->answers_count }} responden
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            @if ($question->answers_count > 0)
                                                <button wire:click="openAnswersModal({{ $question->id }})"
                                                    class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            @endif
                                            <button wire:click="openUpdateModal({{ $question->id }})"
                                                class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button wire:click="openDeleteModal({{ $question->id }})"
                                                class="cursor-pointer rounded-lg p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Facility Summary -->
                            <div
                                class="border-t border-gray-200 bg-{{ $facility->rating_color }}-50 p-4 dark:border-gray-700 dark:bg-{{ $facility->rating_color }}-900/20">
                                <p
                                    class="text-sm text-{{ $facility->rating_color }}-800 dark:text-{{ $facility->rating_color }}-300">
                                    <strong>Kesimpulan:</strong> {!! $this->generateSummary($facility->id) !!}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-8 text-center dark:border-gray-700 dark:bg-gray-800">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Belum ada kuesioner</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai dengan menambahkan kuesioner
                                untuk fasilitas.</p>
                            <button wire:click="openCreateModal"
                                class="bg-primary-700 hover:bg-primary-800 mt-4 inline-flex cursor-pointer items-center rounded-lg px-4 py-2 text-sm font-medium text-white">
                                <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Tambah Kuesioner
                            </button>
                        </div>
                    @endforelse
                </div>
            @endif

            <!-- Questions Tab -->
            @if ($activeTab === 'questions')
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <!-- Search and Filter -->
                    <div
                        class="flex flex-col gap-4 border-b border-gray-200 p-4 dark:border-gray-700 md:flex-row md:items-center md:justify-between">
                        <div class="w-full md:w-1/2">
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live="query" type="text"
                                    class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Cari kuesioner...">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <select wire:model.live="sortKey"
                                class="rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Urutkan</option>
                                <option value="facility">Nama Fasilitas</option>
                                <option value="answers_count">Jumlah Responden</option>
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
                                    <th scope="col" class="px-4 py-3">Responden</th>
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
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                {{ $question->answers_count }} responden
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-end gap-1">
                                                @if ($question->answers_count > 0)
                                                    <button wire:click="openAnswersModal({{ $question->id }})"
                                                        class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600"
                                                        title="Lihat Jawaban">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                                <button wire:click="openUpdateModal({{ $question->id }})"
                                                    class="cursor-pointer rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600"
                                                    title="Edit">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button wire:click="openDeleteModal({{ $question->id }})"
                                                    class="cursor-pointer rounded-lg p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20"
                                                    title="Hapus">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                            {{ $this->questions->links() }}
                        </div>
                    @endif
                </div>
            @endif

            <!-- Periods Tab -->
            @if ($activeTab === 'periods')
            @endif
        </div>

        <!-- Create Modal -->
        @if ($showCreateModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
                <div class="relative max-h-full w-full max-w-2xl p-4">
                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Buat Kuesioner Baru</h3>
                            <button type="button" wire:click="closeCreateModal"
                                class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                        <form wire:submit.prevent="createNewQuestion" class="p-4">
                            <div class="mb-4 flex flex-col gap-4">
                                <div>
                                    <label for="facility"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pilih
                                        Fasilitas</label>
                                    <select id="facility" wire:model="facilityId"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white">
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
                                    <label for="question"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pertanyaan
                                        Kuesioner</label>
                                    <textarea id="question" rows="4" wire:model="question"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Tulis pertanyaan kuesioner di sini..."></textarea>
                                    @error('question')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="-ms-1 me-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Tambahkan Kuesioner
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
                        <div
                            class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Kuesioner</h3>
                            <button type="button" wire:click="closeUpdateModal"
                                class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                        <form wire:submit.prevent="updateQuestion" class="p-4">
                            <div class="mb-4 flex flex-col gap-4">
                                <div>
                                    <label for="facilityUpdate"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pilih
                                        Fasilitas</label>
                                    <select id="facilityUpdate" wire:model="facilityId"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white">
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
                                    <label for="questionUpdate"
                                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Pertanyaan
                                        Kuesioner</label>
                                    <textarea id="questionUpdate" rows="4" wire:model="question"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Tulis pertanyaan kuesioner di sini..."></textarea>
                                    @error('question')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Perbarui Kuesioner
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
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <svg class="mx-auto mb-3.5 h-11 w-11 text-gray-400 dark:text-gray-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda yakin ingin menghapus kuesioner ini?
                        </p>
                        <div class="flex items-center justify-center space-x-4">
                            <button wire:click="closeDeleteModal" type="button"
                                class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
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
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                    @php
                                        $rating = null;
                                        if (preg_match('/^(\d+)/', $answer->content, $matches)) {
                                            $rating = (int) $matches[1];
                                        }
                                        $ratingColor = match ($rating) {
                                            5 => 'green',
                                            4 => 'blue',
                                            3 => 'yellow',
                                            2 => 'orange',
                                            1 => 'red',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                                        <div class="flex items-start justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-{{ $ratingColor }}-100 dark:bg-{{ $ratingColor }}-900">
                                                    <span
                                                        class="text-lg font-bold text-{{ $ratingColor }}-600 dark:text-{{ $ratingColor }}-300">
                                                        {{ $rating ?? '?' }}
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
                                            <span
                                                class="inline-flex items-center rounded-full bg-{{ $ratingColor }}-100 px-2.5 py-0.5 text-xs font-medium text-{{ $ratingColor }}-800 dark:bg-{{ $ratingColor }}-900 dark:text-{{ $ratingColor }}-300">
                                                {{ $answer->content }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-8 text-center">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada jawaban.</p>
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
                        <div
                            class="sticky top-0 z-10 flex items-center justify-between rounded-t border-b bg-white p-4 dark:border-gray-600 dark:bg-gray-800">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Detail: {{ $this->selectedFacilityData['facility']->name }}
                            </h3>
                            <button type="button" wire:click="closeFacilityDetailModal"
                                class="ml-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 md:p-5">
                            <!-- Facility Stats -->
                            <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-4">
                                <div class="rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                                    <p class="text-sm text-blue-600 dark:text-blue-400">Total Kuesioner</p>
                                    <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">
                                        {{ $this->selectedFacilityData['totalQuestions'] }}</p>
                                </div>
                                <div class="rounded-lg bg-purple-50 p-4 dark:bg-purple-900/20">
                                    <p class="text-sm text-purple-600 dark:text-purple-400">Total Jawaban</p>
                                    <p class="text-2xl font-bold text-purple-700 dark:text-purple-300">
                                        {{ $this->selectedFacilityData['totalResponden'] }}</p>
                                </div>
                                <div
                                    class="rounded-lg bg-{{ $this->selectedFacilityData['ratingColor'] }}-50 p-4 dark:bg-{{ $this->selectedFacilityData['ratingColor'] }}-900/20">
                                    <p
                                        class="text-sm text-{{ $this->selectedFacilityData['ratingColor'] }}-600 dark:text-{{ $this->selectedFacilityData['ratingColor'] }}-400">
                                        Rata-rata Rating</p>
                                    <p
                                        class="text-2xl font-bold text-{{ $this->selectedFacilityData['ratingColor'] }}-700 dark:text-{{ $this->selectedFacilityData['ratingColor'] }}-300">
                                        {{ $this->selectedFacilityData['avgRating'] }}/5.0</p>
                                </div>
                                <div
                                    class="rounded-lg bg-{{ $this->selectedFacilityData['ratingColor'] }}-50 p-4 dark:bg-{{ $this->selectedFacilityData['ratingColor'] }}-900/20">
                                    <p
                                        class="text-sm text-{{ $this->selectedFacilityData['ratingColor'] }}-600 dark:text-{{ $this->selectedFacilityData['ratingColor'] }}-400">
                                        Status</p>
                                    <p
                                        class="text-xl font-bold text-{{ $this->selectedFacilityData['ratingColor'] }}-700 dark:text-{{ $this->selectedFacilityData['ratingColor'] }}-300">
                                        {{ $this->selectedFacilityData['ratingLabel'] }}</p>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div
                                class="mb-6 rounded-lg bg-{{ $this->selectedFacilityData['ratingColor'] }}-50 p-4 dark:bg-{{ $this->selectedFacilityData['ratingColor'] }}-900/20">
                                <h4
                                    class="mb-2 font-semibold text-{{ $this->selectedFacilityData['ratingColor'] }}-800 dark:text-{{ $this->selectedFacilityData['ratingColor'] }}-300">
                                    Kesimpulan</h4>
                                <p
                                    class="text-{{ $this->selectedFacilityData['ratingColor'] }}-700 dark:text-{{ $this->selectedFacilityData['ratingColor'] }}-400">
                                    {{ $this->selectedFacilityData['ratingDescription'] }}
                                </p>
                            </div>

                            <!-- Questions List -->
                            <h4 class="mb-4 font-semibold text-gray-900 dark:text-white">Daftar Kuesioner</h4>
                            <div class="space-y-4">
                                @foreach ($this->selectedFacilityData['facility']->questions as $question)
                                    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                                        <div class="mb-2 flex items-start justify-between">
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $question->content }}
                                            </p>
                                            <div class="ml-2 flex items-center gap-2">
                                                <span
                                                    class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    {{ $question->answers_count }} responden
                                                </span>
                                                @if ($question->avg_rating > 0)
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-{{ $question->rating_info['color'] }}-100 px-2 py-1 text-xs font-medium text-{{ $question->rating_info['color'] }}-800 dark:bg-{{ $question->rating_info['color'] }}-900 dark:text-{{ $question->rating_info['color'] }}-300">
                                                        {{ $question->avg_rating }}/5.0
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
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
                const ratingCtx = document.getElementById('facilityRatingChart');
                const distributionCtx = document.getElementById('ratingDistributionChart');

                if (!ratingCtx || !distributionCtx) return;

                // Destroy existing charts
                if (window.facilityRatingChart instanceof Chart) {
                    window.facilityRatingChart.destroy();
                }
                if (window.ratingDistributionChart instanceof Chart) {
                    window.ratingDistributionChart.destroy();
                }

                const chartData = @json($this->chartData);
                const statsData = @json($this->overviewStats);

                // Bar Chart - Rating per Facility
                window.facilityRatingChart = new Chart(ratingCtx, {
                    type: 'bar',
                    data: {
                        labels: chartData.facilityLabels,
                        datasets: [{
                            label: 'Rata-rata Rating',
                            data: chartData.avgRatings,
                            backgroundColor: chartData.ratingColors,
                            borderColor: chartData.ratingColors.map(c => c.replace('0.8', '1')),
                            borderWidth: 1,
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const rating = context.raw;
                                        const label = chartData.ratingLabels[context.dataIndex];
                                        return `Rating: ${rating}/5.0 (${label})`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 5,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });

                // Doughnut Chart - Rating Distribution
                const distributionColors = [
                    'rgba(239, 68, 68, 0.8)', // 1 - Red
                    'rgba(249, 115, 22, 0.8)', // 2 - Orange
                    'rgba(234, 179, 8, 0.8)', // 3 - Yellow
                    'rgba(59, 130, 246, 0.8)', // 4 - Blue
                    'rgba(34, 197, 94, 0.8)', // 5 - Green
                ];

                window.ratingDistributionChart = new Chart(distributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Sangat Tidak Puas (1)', 'Tidak Puas (2)', 'Cukup (3)', 'Puas (4)', 'Sangat Puas (5)'],
                        datasets: [{
                            data: [
                                statsData.ratingDistribution[1],
                                statsData.ratingDistribution[2],
                                statsData.ratingDistribution[3],
                                statsData.ratingDistribution[4],
                                statsData.ratingDistribution[5],
                            ],
                            backgroundColor: distributionColors,
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
