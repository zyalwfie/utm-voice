<section class="mx-auto mb-14 mt-28 max-w-screen-xl bg-white p-4 dark:bg-gray-900">
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="md:h-130 relative h-56 overflow-hidden rounded-lg">
            <!-- Item 1 -->
            @foreach ($facility->getMedia('carousel') as $media)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                        src="{{ $media->getUrl() }}" alt="{{ $facility->name }}">
                </div>
            @endforeach
        </div>

        <!-- Slider indicators -->
        <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="h-3 w-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
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
                <p>{{ $facility->description }}</p>
            </div>

            <div class="mb-6">
                <div class="mb-4">
                    <h3 class="mb-1 text-lg font-semibold">Ringkasan</h3>
                    <p class="text-base">Ulasan sudah terverifikasi dan mereka adalah mahasiswa dari kampus
                        Universitas Teknologi Mataram</p>
                </div>
                <div class="flex gap-8">
                    <div class="flex flex-col gap-1">
                        <div class="text-7xl">
                            {{ number_format($this->facility->comments->avg('rating'), 1) }}
                        </div>
                        <div class="flex items-center gap-3">
                            <div x-data="{ rating: @json(round($this->facility->comments->avg('rating'), 1)) }" class="flex items-center gap-1">
                                <template x-for="star in 5" :key="star">
                                    <svg class="h-4 w-4"
                                        :class="{
                                            'text-yellow-400': star <= Math.floor(rating),
                                            'text-gray-300 dark:text-gray-600': star > Math.floor(rating)
                                        }"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                </template>
                            </div>
                            <div class="text-base">
                                ({{ count($facility->comments) }})
                            </div>
                        </div>
                    </div>

                    @php
                        $totalComments = $facility->comments->count();
                        $ratingsCount = [];
                        $bgClass = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-teal-400', 'bg-emerald-400'];

                        for ($i = 1; $i <= 5; $i++) {
                            $ratingsCount[$i] = $facility->comments->where('rating', $i)->count();
                        }

                        function ratingPercentage($count, $total)
                        {
                            return $total > 0 ? round(($count / $total) * 100) : 0;
                        }
                    @endphp

                    <div class="grid grow grid-cols-12 items-center gap-x-2 gap-y-2">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="text-center text-gray-500 dark:text-gray-300">{{ $i }}</div>
                            <div class="col-span-9 h-3 overflow-hidden rounded-md bg-slate-200">
                                <div class="{{ $bgClass[$i - 1] }} h-full transition-all duration-300"
                                    style="width: {{ ratingPercentage($ratingsCount[$i], $totalComments) }}%"></div>
                            </div>
                            <div class="col-span-2">{{ ratingPercentage($ratingsCount[$i], $totalComments) }}%</div>
                        @endfor
                    </div>

                </div>
            </div>
        </div>

        <div class="col-span-2 flex flex-col gap-16 lg:flex-row">
            <div class="flex flex-col gap-4 lg:w-1/2">
                <form wire:submit='createNewReview' action="#" class="flex flex-col gap-8">
                    <h3 class="mb-6 text-lg font-semibold">Tulis ulasanmu</h3>
                    <div class="flex items-start gap-4">
                        <input wire:model='form.facility_id' type="hidden" value="{{ $facility->id }}">
                        <div class="grow">
                            <label for="student_id_number"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">Identitas</label>
                            <input wire:model.lazy='form.student_id' type="text" id="student_id_number"
                                class="@if ($isStudentIdValid) bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500 @error('form.student_id') placeholder:text-red-700 bg-red-50 border-red-300 @enderror @endif focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                placeholder="Tuliskan nim kamu">
                            @if ($isStudentIdValid)
                                <p class="mt-2 text-xs text-green-600 dark:text-green-500"><span
                                        class="font-medium">Bagus!</span> Identitasmu valid!</p>
                            @else
                                @error('form.student_id')
                                    <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            @endif
                        </div>
                        <div class="grow">
                            <label for="name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">Nama</label>
                            <input type="text" id="name" disabled
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-200 p-2.5 text-sm text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                placeholder="{{ $student?->name ?? 'Nama otomatis diisi sesuai dengan NIM' }}">
                        </div>
                    </div>
                    <div x-data="{ rating: @entangle('form.rating'), hoverRating: 0 }" class="flex">
                        <div class="grow">
                            <label
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">Bintang</label>
                            <div class="flex items-center space-x-1">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click="rating = star; hoverRating = 0;"
                                        @mouseover="hoverRating = star" @mouseleave="hoverRating = 0"
                                        class="cursor-pointer text-2xl transition focus:outline-none"
                                        :class="{
                                            'text-yellow-400': star <= rating || (star <= hoverRating && star > rating),
                                            'text-gray-300 dark:text-gray-600': star > rating && star > hoverRating
                                        }">
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            @error('form.rating')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input x-model='rating' type="hidden" name="rating" />
                    </div>
                    <div class="sm:col-span-2">
                        <label for="content"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-400">Ulasan</label>
                        <textarea wire:model='form.content' id="content" rows="6"
                            class="@error('form.content') border-red-300 @enderror focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="Ceritakan pengalamanmu..."></textarea>
                        @error('form.content')
                            <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button wire:click.prevent='createNewReview' type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex cursor-pointer items-center justify-center gap-2 rounded-lg px-5 py-3 text-sm font-medium text-white focus:outline-none focus:ring-4">
                        <span>Kirim ulasan</span>
                        <svg wire:loading wire:target='createNewReview' aria-hidden="true" role="status"
                            class="inline h-4 w-4 animate-spin text-gray-200 dark:text-gray-600" viewBox="0 0 100 101"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="#1C64F2" />
                        </svg>
                    </button>
                </form>
                <hr class="my-4">
                <form wire:submit.prevent='createNewQuestionnaire' class="space-y-4" action="#">
                    <h3 class="mb-6 text-lg font-semibold">Isi kuesioner</h3>

                    <div class="grow">
                        <label for="student_id_number_evaluate"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">Identitas</label>
                        <input wire:model.lazy='evaluateForm.student_id' type="text"
                            id="student_id_number_evaluate"
                            class="@if ($isEvaluateFormStudentId) bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500 @else shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light @endif @error('evaluateForm.student_id') placeholder:text-red-700 bg-red-50 border-red-300 @enderror"
                            placeholder="Tuliskan nim kamu">
                        @if ($isEvaluateFormStudentId)
                            <p class="mt-2 text-xs text-green-600 dark:text-green-500"><span
                                    class="font-medium">Bagus!</span> Identitasmu valid!</p>
                        @else
                            @error('evaluateForm.student_id')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>

                    @forelse ($this->questions as $question)
                        <div>
                            <h4 class="mb-2 text-sm font-medium">{{ $question->content }}? <sup
                                    class="text-red-500">*</sup></h4>
                            <label for="answer_{{ $question->id }}"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                            <textarea id="answer_{{ $question->id }}" rows="4" wire:model='evaluateForm.answers.{{ $question->id }}'
                                class="@error('evaluateForm.answers.' . $question->id) border-red-300 @enderror block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="Tulis jawaban Anda di sini..."></textarea>
                            @error('evaluateForm.answers.' . $question->id)
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @empty
                        <div>
                            <h4 class="mb-4 text-center font-medium">
                                Kuesioner belum tersedia untuk fasilitas ini.
                            </h4>
                        </div>
                    @endforelse

                    @error('evaluateForm.answers')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (count($this->questions) == 0)
                        <button type="button" data-modal-hide="evaluateModal"
                            class="w-full cursor-pointer rounded-lg bg-gray-700 px-5 py-2.5 text-center text-sm font-medium text-white transition hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</button>
                    @else
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span>Kirim Kuesioner</span>
                            <svg wire:loading wire:target='createNewQuestionnaire' aria-hidden="true" role="status"
                                class="inline h-4 w-4 animate-spin text-gray-200 dark:text-gray-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C0 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="#1C64F2" />
                            </svg>
                        </button>
                    @endif
                </form>
            </div>
            <div class="lg:w-1/2">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Ulasan</h3>
                    <div class="min-w-45 flex gap-2">
                        <select wire:model.live='sortKey'
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            <option value="">Urut berdasarkan</option>
                            <option value="1">Bintang 1</option>
                            <option value="2">Bintang 2</option>
                            <option value="3">Bintang 3</option>
                            <option value="4">Bintang 4</option>
                            <option value="5">Bintang 5</option>
                        </select>
                    </div>
                </div>
                <div class="mb-6 flex flex-col gap-6">
                    @forelse ($this->comments as $comment)
                        <article
                            class="rounded-r-lg border-l-4 border-l-yellow-400 bg-white pl-4 text-base dark:bg-gray-900">
                            <footer class="mb-4">
                                <div class="flex grow items-center gap-4">
                                    <img class="h-12 w-12 rounded-full" src="{{ asset($comment->user->avatar) }}"
                                        alt="{{ $comment->user->name }}">
                                    <div class="flex grow items-center justify-between">
                                        <div>
                                            <p class="mb-1 font-semibold">{{ $comment->user->name }}</p>
                                            <div class="flex items-center gap-2">
                                                <div class="flex items-center gap-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="{{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }} h-4 w-4"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <time pubdate datetime="{{ $comment->created_at }}"
                                                title="{{ $comment->created_at }}"
                                                class="text-sm text-gray-500">{{ $comment->created_at?->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        </article>
                    @empty
                        <div class="py-8 text-center text-gray-500">
                            @if (!empty($sortKey))
                                Tidak ada ulasan dengan rating {{ $sortKey }} bintang
                            @else
                                Belum ada ulasan
                            @endif
                        </div>
                    @endforelse
                </div>
                @if ($this->shouldShowLoadMoreButton())
                    <button wire:click='loadAllComments'
                        class="flex cursor-pointer items-center gap-2 rounded-md border px-4 py-2 transition hover:bg-slate-400 hover:text-white">
                        @if ($showAllComments)
                            <span>Lihat sedikit ulasan</span>
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        @else
                            <span>Lihat semua ulasan ({{ $this->getTotalCommentsCount() }})</span>
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        @endif
                    </button>
                @endif
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="flex justify-center" x-data="{ show: true }">
            <div id="toast-success" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="top-22 fixed right-8 z-40 mb-4 flex min-w-max items-center rounded-lg bg-white p-4 text-gray-500 shadow-sm dark:bg-gray-800 dark:text-gray-400"
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
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    data-dismiss-target="#toast-success" aria-label="Close">
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
