<x-guest-layout>
    <div class="max-w-md w-full mx-auto bg-white dark:bg-slate-800 p-8 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.04)] border border-slate-100/50 dark:border-slate-700/50 transition-colors duration-300">

        <div class="flex justify-center mb-6">
            <div class="w-14 h-14 bg-gradient-to-br from-slate-700 to-slate-900 dark:from-emerald-500 dark:to-emerald-700 rounded-2xl flex items-center justify-center shadow-inner transition-colors">
                <div class="grid grid-cols-2 gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-white/40"></div>
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white/40"></div>
                </div>
            </div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight transition-colors">Login</h2>
            <p class="text-sm text-slate-400 dark:text-slate-400 mt-1.5 transition-colors">Please sign in to start your inventory session.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 dark:bg-green-500/10 dark:text-green-400 p-3 rounded-xl border border-green-100 dark:border-green-500/20 transition-colors">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400 dark:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615m19.5 0A2.25 2.25 0 0 0 19.5 6.75" />
                        </svg>
                    </span>
                    <input id="email" class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-transparent dark:border-slate-700 focus:border-slate-200 dark:focus:border-slate-600 focus:bg-white dark:focus:bg-slate-900 focus:ring-0 rounded-2xl text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 transition-all duration-200" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                </div>
                @error('email')
                    <span class="text-xs text-red-500 dark:text-red-400 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400 dark:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v-6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <input id="password" class="block w-full pl-12 pr-12 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-transparent dark:border-slate-700 focus:border-slate-200 dark:focus:border-slate-600 focus:bg-white dark:focus:bg-slate-900 focus:ring-0 rounded-2xl text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 transition-all duration-200" type="password" name="password" placeholder="Password" required />
                    <span class="absolute right-4 text-slate-400 dark:text-slate-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </span>
                </div>
                @error('password')
                    <span class="text-xs text-red-500 dark:text-red-400 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mb-6">
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3.5 bg-slate-900 dark:bg-emerald-500 hover:bg-slate-800 dark:hover:bg-emerald-600 text-white font-semibold text-sm rounded-2xl transition-all duration-200 shadow-sm">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-slate-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-500 dark:hover:text-emerald-400 hover:underline ml-1 transition-colors">Sign Up</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = passwordInput.nextElementSibling;

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'text') {
                    this.classList.remove('text-slate-400', 'dark:text-slate-500');
                    this.classList.add('text-slate-800', 'dark:text-white');
                } else {
                    this.classList.remove('text-slate-800', 'dark:text-white');
                    this.classList.add('text-slate-400', 'dark:text-slate-500');
                }
            });
        });
    </script>
</x-guest-layout>