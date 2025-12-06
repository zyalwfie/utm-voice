<section class="mx-auto mb-14 mt-28 max-w-screen-xl bg-white p-4 dark:bg-gray-900">
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="md:h-130 relative h-56 overflow-hidden rounded-lg">
            @foreach ($facility->getMedia('carousel') as $media)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                        src="{{ $media->getUrl() }}" alt="{{ $facility->name }}">
                </div>
            @endforeach
        </div>

        <!-- Slider indicators -->
        <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse">
            @foreach ($facility->getMedia('carousel') as $index => $media)
                <button type="button" class="h-3 w-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
            @endforeach
        </div>

        <!-- Slider controls -->
        <button type="button"
            class="group absolute start-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                <svg class="h-4 w-4 text-white rtl:rotate-180 dark:text-gray-800" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="group absolute end-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                <svg class="h-4 w-4 text-white rtl:rotate-180 dark:text-gray-800" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <div class="mb-8 items-start gap-16 lg:grid lg:grid-cols-2 lg:py-16">
        <div class="mb-8 mt-8 grid grid-cols-2 gap-4 lg:mb-0">
            @foreach ($facility->getMedia('detail') as $index => $media)
                <img class="@if ($index != 0) mt-4 @endif w-full rounded-lg"
                    src="{{ $media->getUrl() }}" alt="{{ $facility->name }}">
            @endforeach
        </div>

        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            <div class="mb-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        {{ $facility->name }}
                    </h2>
                </div>
                <p class="mb-6">{{ $facility->description }}</p>

                @guest
                    <a href="{{ route('login') }}"
                        class="inline-flex border border-blue-800 items-center gap-2 text-blue-800 hover:text-blue-50 rounded-lg px-5 py-3 text-center text-sm font-medium hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                        </svg>
                        <span>Masuk sebelum isi kuesioner</span>
                    </a>
                @endguest
                @auth
                    <!-- Questionnaire Button -->
                    <button data-modal-target="questionnaireModal" data-modal-toggle="questionnaireModal" type="button"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-5 py-3 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                        </svg>
                        <span>Isi Kuesioner Fasilitas</span>
                    </button>
                @endauth
            </div>
        </div>
    </div>

    <!-- Questionnaire Modal -->
    <div id="questionnaireModal" tabindex="-1" aria-hidden="true" wire:ignore.self
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30">
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 md:p-5 dark:border-gray-600">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Kuesioner Fasilitas
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $facility->name }}</p>
                        </div>
                    </div>
                    <button type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                        data-modal-hide="questionnaireModal">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="space-y-4 p-4 md:p-5">
                    <!-- User Info Card -->
                    <div
                        class="flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-600 dark:bg-gray-800">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ auth()->user()->name ?? 'Nama Mahasiswa' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">NIM:
                                {{ auth()->user()->student_id ?? '-' }}</p>
                        </div>
                        <div class="ml-auto">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                Terverifikasi
                            </span>
                        </div>
                    </div>

                    <!-- Rating Scale Legend -->
                    <div
                        class="rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/30">
                        <p class="mb-2 text-sm font-medium text-blue-800 dark:text-blue-300">Skala Penilaian:</p>
                        <div class="flex flex-wrap gap-2 text-xs">
                            <span
                                class="inline-flex items-center gap-1 rounded bg-red-100 px-2 py-1 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                <span class="font-bold">1</span> Sangat Tidak Puas
                            </span>
                            <span
                                class="inline-flex items-center gap-1 rounded bg-orange-100 px-2 py-1 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300">
                                <span class="font-bold">2</span> Tidak Puas
                            </span>
                            <span
                                class="inline-flex items-center gap-1 rounded bg-yellow-100 px-2 py-1 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">
                                <span class="font-bold">3</span> Cukup
                            </span>
                            <span
                                class="inline-flex items-center gap-1 rounded bg-lime-100 px-2 py-1 text-lime-800 dark:bg-lime-900/50 dark:text-lime-300">
                                <span class="font-bold">4</span> Puas
                            </span>
                            <span
                                class="inline-flex items-center gap-1 rounded bg-green-100 px-2 py-1 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                <span class="font-bold">5</span> Sangat Puas
                            </span>
                        </div>
                    </div>

                    <form wire:submit.prevent='createNewQuestionnaire' class="space-y-4">
                        <!-- Hidden student_id field -->
                        <input type="hidden" wire:model='evaluateForm.student_id'
                            value="{{ auth()->user()->student_id ?? '' }}">

                        <!-- Questions Section -->
                        <div class="max-h-80 space-y-4 overflow-y-auto pr-2">
                            @forelse ($this->questions as $index => $question)
                                <div
                                    class="rounded-lg border border-gray-200 bg-gray-50 p-4 transition-all dark:border-gray-600 dark:bg-gray-800 @error('evaluateForm.answers.' . $question->id) !border-red-500 !bg-red-50 dark:!bg-red-900/20 @enderror">
                                    <div class="mb-4 flex items-start gap-3">
                                        <span
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ $index + 1 }}
                                        </span>
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $question->content }}? <span class="text-red-500">*</span>
                                        </h4>
                                    </div>

                                    <!-- Radio Button Rating -->
                                    <div class="ml-9">
                                        <div class="flex items-center justify-between gap-1 sm:gap-2">
                                            @for ($rating = 1; $rating <= 5; $rating++)
                                                @php
                                                    $colorClasses = [
                                                        1 => 'peer-checked:border-red-500 peer-checked:bg-red-500 hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/30',
                                                        2 => 'peer-checked:border-orange-500 peer-checked:bg-orange-500 hover:border-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/30',
                                                        3 => 'peer-checked:border-yellow-500 peer-checked:bg-yellow-500 hover:border-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/30',
                                                        4 => 'peer-checked:border-lime-500 peer-checked:bg-lime-500 hover:border-lime-400 hover:bg-lime-50 dark:hover:bg-lime-900/30',
                                                        5 => 'peer-checked:border-green-500 peer-checked:bg-green-500 hover:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/30',
                                                    ];
                                                    $labels = [
                                                        1 => 'Sangat Tidak Puas',
                                                        2 => 'Tidak Puas',
                                                        3 => 'Cukup',
                                                        4 => 'Puas',
                                                        5 => 'Sangat Puas',
                                                    ];
                                                @endphp
                                                <label class="flex flex-1 cursor-pointer flex-col items-center">
                                                    <input type="radio"
                                                        wire:model='evaluateForm.answers.{{ $question->id }}'
                                                        name="question_{{ $question->id }}"
                                                        value="{{ $rating }}" class="peer sr-only">
                                                    <span
                                                        class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300 bg-white text-sm font-bold text-gray-500 transition-all peer-checked:text-white dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 sm:h-10 sm:w-10 {{ $colorClasses[$rating] }}">
                                                        {{ $rating }}
                                                    </span>
                                                    <span
                                                        class="mt-1 hidden text-center text-[10px] leading-tight text-gray-500 dark:text-gray-400 sm:block text-xs">
                                                        {{ $labels[$rating] }}
                                                    </span>
                                                </label>
                                            @endfor
                                        </div>

                                        @error('evaluateForm.answers.' . $question->id)
                                            <p class="mt-3 flex items-center gap-1 text-sm text-red-600 dark:text-red-500">
                                                <svg class="h-4 w-4 shrink-0" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                                                </svg>
                                                <span>{{ $message }}</span>
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center py-8 text-center">
                                    <svg class="mb-4 h-12 w-12 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                                    </svg>
                                    <h4 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">
                                        Belum Ada Kuesioner
                                    </h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Kuesioner untuk fasilitas ini belum tersedia saat ini.
                                    </p>
                                </div>
                            @endforelse
                        </div>

                        <!-- General Error Message -->
                        @error('evaluateForm.answers')
                            <div
                                class="flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-red-900/30 dark:text-red-400">
                                <svg class="h-5 w-5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                        @error('evaluateForm.student_id')
                            <div
                                class="flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-red-900/30 dark:text-red-400">
                                <svg class="h-5 w-5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Modal footer -->
                        <div class="flex items-center gap-3 border-t border-gray-200 pt-4 dark:border-gray-600">
                            @if (count($this->questions) == 0)
                                <button type="button" data-modal-hide="questionnaireModal"
                                    class="w-full rounded-lg bg-gray-700 px-5 py-2.5 text-center text-sm font-medium text-white transition hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                    Tutup
                                </button>
                            @else
                                <button type="button" data-modal-hide="questionnaireModal"
                                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex grow items-center justify-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg wire:loading.remove wire:target='createNewQuestionnaire' class="h-4 w-4"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    <svg wire:loading wire:target='createNewQuestionnaire' aria-hidden="true"
                                        role="status" class="inline h-4 w-4 animate-spin text-white"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" fill-opacity="0.3" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span wire:loading.remove wire:target='createNewQuestionnaire'>Kirim
                                        Kuesioner</span>
                                    <span wire:loading wire:target='createNewQuestionnaire'>Mengirim...</span>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast Notification -->
    @if (Session::has('success'))
        <div class="flex justify-center" x-data="{ show: true }">
            <div id="toast-success" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="top-22 fixed right-8 z-50 mb-4 flex min-w-max items-center rounded-lg bg-white p-4 text-gray-500 shadow-lg dark:bg-gray-800 dark:text-gray-400"
                role="alert">
                <div
                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ Session::get('success') }}</div>
                <button type="button" @click="show = false"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Error Toast Notification -->
    @if (Session::has('error'))
        <div class="flex justify-center" x-data="{ show: true }">
            <div id="toast-error" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="top-22 fixed right-8 z-50 mb-4 flex min-w-max items-center rounded-lg bg-white p-4 text-gray-500 shadow-lg dark:bg-gray-800 dark:text-gray-400"
                role="alert">
                <div
                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-500 dark:bg-red-800 dark:text-red-200">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ Session::get('error') }}</div>
                <button type="button" @click="show = false"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
</section>
