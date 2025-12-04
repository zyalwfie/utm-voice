<footer class="p-4 bg-white sm:p-6 dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0 flex flex-col gap-2">
                <a href="#" class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="UTM Voice Logo" class="w-8 h-8">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">UTM Voice</span>
                </a>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Platform ini lahir dari aspirasi mahasiswa,<br /> untuk
                    berbagi cerita jujur dan membangun<br />kampus yang lebih baik bersama.</p>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Navigasi</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="{{ route('landing.facility.index') }}" class="hover:underline">Jelajahi</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Ikuti Kami</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4"><a href="#" class="hover:underline">Instagram</a></li>
                        <li><a href="#" class="hover:underline">Twitter (X)</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="#"
                    class="hover:underline">UTM Voice™</a>. All Rights Reserved.</span>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">Dibuat dan didesign oleh
                Zulkarnaen</span>
        </div>
    </div>
</footer>
