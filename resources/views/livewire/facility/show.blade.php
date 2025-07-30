<section class="bg-white p-4 mx-auto max-w-screen-xl dark:bg-gray-900 mt-28 mb-14">
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-130">
            <!-- Item 1 -->
            @foreach ($facility->getMedia('carousel') as $media)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        src="{{ $media->getUrl() }}" alt="{{ $facility->name }}">
                </div>
            @endforeach
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>

        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <div class="gap-16 items-start lg:grid lg:grid-cols-2 lg:py-16 mb-8">
        <div class="grid grid-cols-2 gap-4 mt-8 mb-8 lg:mb-0">
            @foreach ($facility->getMedia('detail') as $index => $media)
                <img class="w-full rounded-lg @if ($index != 0) mt-4 @endif"
                    src="{{ $media->getUrl() }}" alt="{{ $facility->name }}">
            @endforeach
        </div>

        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            <div class="mb-6">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        {{ $facility->name }}
                    </h2>
                    <button data-modal-target="evaluateModal" data-modal-toggle="evaluateModal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Isi kuesioner
                    </button>
                </div>
                <p>{{ $facility->description }}</p>
            </div>

            <div class="mb-6">
                <div class="mb-4">
                    <h3 class="font-semibold text-lg mb-1">Ringkasan</h3>
                    <p class="text-base">Ulasan sudah terverifikasi dan mereka adalah mahasiswa dari kampus
                        Universitas Teknologi Mataram</p>
                </div>
                <div class="flex gap-8">
                    <div class="flex flex-col gap-1">
                        <div class="text-7xl">
                            {{ number_format($this->facility->comments->avg('rating'), 1) }}
                        </div>
                        <div class="flex items-center gap-3">
                            <div x-data="{ rating: @json(round($this->facility->comments->avg('rating'), 1)) }" class="flex gap-1 items-center">
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

                    <div class="grid grid-cols-12 gap-y-2 gap-x-2 grow items-center">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="text-center text-gray-500 dark:text-gray-300">{{ $i }}</div>
                            <div class="rounded-md h-3 bg-slate-200 col-span-9 overflow-hidden">
                                <div class="{{ $bgClass[$i - 1] }} h-full transition-all duration-300"
                                    style="width: {{ ratingPercentage($ratingsCount[$i], $totalComments) }}%"></div>
                            </div>
                            <div class="col-span-2">{{ ratingPercentage($ratingsCount[$i], $totalComments) }}%</div>
                        @endfor
                    </div>

                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-16 col-span-2">
            <div class="lg:w-1/2 flex flex-col gap-4">
                <form wire:submit='createNewReview' action="#" class="space-y-8">
                    <h3 class="font-semibold text-lg mb-6">Tulis ulasanmu</h3>
                    <div class="flex gap-4 items-start">
                        <input wire:model='form.facility_id' type="hidden" value="{{ $facility->id }}">
                        <div class="grow">
                            <label for="student_id_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Identitas</label>
                            <input wire:model.lazy='form.student_id' type="text" id="student_id_number"
                                class="@if ($isStudentIdValid) bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500 @error('form.student_id') placeholder:text-red-700 bg-red-50 border-red-300 @enderror @endif shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
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
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama</label>
                            <input type="text" id="name" disabled
                                class="shadow-sm bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light cursor-not-allowed"
                                placeholder="{{ $student?->name ?? 'Nama otomatis diisi sesuai dengan NIM' }}">
                        </div>
                    </div>
                    <div x-data="{ rating: @entangle('form.rating'), hoverRating: 0 }" class="flex">
                        <div class="grow">
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bintang</label>
                            <div class="flex items-center space-x-1">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click="rating = star; hoverRating = 0;"
                                        @mouseover="hoverRating = star" @mouseleave="hoverRating = 0"
                                        class="text-2xl focus:outline-none cursor-pointer transition"
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
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Ulasan</label>
                        <textarea wire:model='form.content' id="content" rows="6"
                            class="@error('form.content') border-red-300 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ceritakan pengalamanmu..."></textarea>
                        @error('form.content')
                            <p class="mt-2 text-xs text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button wire:click.prevent='createNewReview' type="submit"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex items-center gap-2 w-">
                        <span>Kirim ulasan</span>
                        <svg wire:loading wire:target='createNewReview' aria-hidden="true" role="status"
                            class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101"
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
                    <h3 class="font-semibold text-lg mb-6">Isi kuesioner</h3>
                    <input wire:model='form.facility_id' type="hidden" value="{{ $facility->id }}"
                        name="facility_id" />
                    <div class="grow">
                        <label for="student_id_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Identitas</label>
                        <input wire:model.lazy='evaluateForm.student_id' type="text" id="student_id_number"
                            class="@if ($isEvaluateFormStudentId) bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500 @error('evaluateForm.student_id') placeholder:text-red-700 bg-red-50 border-red-300 @enderror @endif shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
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
                            <input wire:model='evaluateForm.question_id' type="hidden" class="opacity-0 absolute" name="question_id" value="{{ $question->id }}">
                            <h4 class="font-medium text-sm mb-2">{{ $question->content }}? <sup
                                    class="text-red-500">*</sup></h4>
                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pesan</label>
                            <textarea id="message" rows="4" wire:model='evaluateForm.answer'
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tulis pendapat Anda di sini..."></textarea>
                        </div>
                    @empty
                        <div>
                            <h4 class="font-medium mb-4 text-center">
                                Kuesioner belum tersedia untuk fasilitas ini.
                            </h4>
                        </div>
                    @endforelse

                    @if (empty($this->questions))
                        <button type="button" data-modal-hide="evaluateModal"
                            class="w-full text-white bg-gray-700 transition cursor-pointer hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</button>
                    @else
                        <button type="submit" wire:submit.prevent='createNewQuestionnaire'
                            data-modal-hide="evaluateModal"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selesai</button>
                    @endif
                </form>
            </div>
            <div class="lg:w-1/2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-semibold text-lg">Ulasan</h3>
                    <div class="flex gap-2 min-w-45">
                        <select wire:model.live='sortKey'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Urut berdasarkan</option>
                            <option value="1">Bintang 1</option>
                            <option value="2">Bintang 2</option>
                            <option value="3">Bintang 3</option>
                            <option value="4">Bintang 4</option>
                            <option value="5">Bintang 5</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col gap-6 mb-6">
                    @forelse ($this->comments as $comment)
                        <article
                            class="text-base bg-white rounded-r-lg dark:bg-gray-900 border-l-4 border-l-yellow-400 pl-4">
                            <footer class="mb-4">
                                <div class="flex items-center gap-4 grow">
                                    <img class="h-12 w-12 rounded-full" src="{{ asset($comment->user->avatar) }}"
                                        alt="{{ $comment->user->name }}">
                                    <div class="flex justify-between items-center grow">
                                        <div>
                                            <p class="font-semibold mb-1">{{ $comment->user->name }}</p>
                                            <div class="flex items-center gap-2">
                                                <div class="flex gap-1 items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="h-4 w-4 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
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
                        <div class="text-center py-8 text-gray-500">
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
                        class="px-4 py-2 rounded-md border flex items-center gap-2 hover:bg-slate-400 cursor-pointer transition hover:text-white">
                        @if ($showAllComments)
                            <span>Lihat sedikit ulasan</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        @else
                            <span>Lihat semua ulasan ({{ $this->getTotalCommentsCount() }})</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
                class="fixed top-22 right-8 flex items-center p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 z-40 min-w-max"
                role="alert">
                <div
                    class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ Session::get('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
</section>
