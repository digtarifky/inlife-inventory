<x-guest-layout>
    <div class="max-w-md w-full mx-auto bg-white dark:bg-slate-800 p-8 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.04)] border border-slate-100/50 dark:border-slate-700/50 relative transition-colors duration-300">
        
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

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight transition-colors">Reset Password</h2>
            <p class="text-xs text-slate-400 mt-2 px-4 leading-relaxed transition-colors">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-5 font-medium text-xs text-green-600 bg-green-50 dark:bg-green-500/10 dark:text-green-400 p-3.5 rounded-xl border border-green-100 dark:border-green-500/20 text-center animate-fade-in transition-colors">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-5">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400 dark:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615m19.5 0A2.25 2.25 0 0 0 19.5 6.75" />
                        </svg>
                    </span>
                    <input id="email" class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-transparent dark:border-slate-700 focus:border-slate-200 dark:focus:border-slate-600 focus:bg-white dark:focus:bg-slate-900 focus:ring-0 rounded-2xl text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 transition-all duration-200" 
                           type="email" 
                           name="email" 
                           placeholder="Email Address"
                           :value="old('email')" 
                           required 
                           autofocus />
                </div>
                @error('email')
                    <span class="text-xs text-red-500 dark:text-red-400 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full py-3.5 bg-slate-900 dark:bg-emerald-500 hover:bg-slate-800 dark:hover:bg-emerald-600 text-white font-semibold text-sm rounded-2xl transition-all duration-200 shadow-sm">
                Reset Password
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-slate-400">
            Remembered your password? 
            <a href="{{ route('login') }}" class="font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-500 dark:hover:text-emerald-400 hover:underline ml-1 transition-colors">Sign In</a>
        </div>
    </div>

    @if (session('demo_url'))
        <div id="demoModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 invisible opacity-0 transition-all duration-300 ease-out">
            <div class="absolute inset-0 bg-slate-900/40 dark:bg-slate-950/80 backdrop-blur-sm transition-opacity duration-300"></div>
            
            <div class="bg-white dark:bg-slate-800 rounded-[28px] max-w-sm w-full p-6 shadow-2xl border border-slate-100 dark:border-slate-700 relative z-10 transform scale-95 translate-y-4 transition-all duration-300 ease-out">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 11.056 1.287l-.056.02-.041.02a.75.75 0 11-.056-1.287l.056-.02zM12 20.25a8.25 8.25 0 100-16.5 8.25 8.25 0 000 16.5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 dark:text-white">Reset Password</h4>
                        <p class="text-[11px] text-slate-400">Change your password</p>
                    </div>
                </div>

                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-6">
                    Click the reset button now to update your password.
                </p>

                <div class="space-y-2">
                    <a href="{{ session('demo_url') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-sm shadow-emerald-200 dark:shadow-emerald-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        Reset Now
                    </a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('demoModal');
                const modalBox = modal.querySelector('.transform');

                setTimeout(() => {
                    modal.classList.remove('invisible', 'opacity-0');
                    modalBox.classList.remove('scale-95', 'translate-y-4');
                    modalBox.classList.add('scale-100', 'translate-y-0');
                }, 150);
            });
        </script>
    @endif
</x-guest-layout>