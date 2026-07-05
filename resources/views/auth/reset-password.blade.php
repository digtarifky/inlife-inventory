<x-guest-layout>
    <div class="max-w-md w-full mx-auto bg-white p-8 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.04)] border border-slate-100/50">
        
        <div class="flex justify-center mb-6">
            <div class="w-14 h-14 bg-gradient-to-br from-slate-700 to-slate-900 rounded-2xl flex items-center justify-center shadow-inner">
                <div class="grid grid-cols-2 gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-white/40"></div>
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white/40"></div>
                </div>
            </div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Create New Password</h2>
            <p class="text-sm text-slate-400 mt-1.5">Please enter your new security credentials.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 flex items-center justify-center text-slate-400 w-5 h-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615m19.5 0A2.25 2.25 0 0 0 19.5 6.75" />
                        </svg>
                    </span>
                    <input id="email" class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 border-transparent rounded-2xl text-sm text-slate-500 cursor-not-allowed" 
                           type="email" 
                           name="email" 
                           value="{{ old('email', $request->email) }}" 
                           required 
                           readonly />
                </div>
                @error('email')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 flex items-center justify-center text-slate-400 w-5 h-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v-6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <input id="password" class="block w-full pl-12 pr-12 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all duration-200"
                           type="password"
                           name="password"
                           placeholder="New Password"
                           required />
                    <span class="absolute right-4 flex items-center justify-center text-slate-400 cursor-pointer w-5 h-5 toggle-password-btn" data-target="password">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </span>
                </div>
                @error('password')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <div class="relative flex items-center">
                    <span class="absolute left-4 flex items-center justify-center text-slate-400 w-5 h-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v-6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <input id="password_confirmation" class="block w-full pl-12 pr-12 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all duration-200"
                           type="password"
                           name="password_confirmation"
                           placeholder="Confirm New Password"
                           required />
                    <span class="absolute right-4 flex items-center justify-center text-slate-400 cursor-pointer w-5 h-5 toggle-password-btn" data-target="password_confirmation">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </span>
                </div>
                @error('password_confirmation')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-2xl transition-all duration-200 shadow-sm">
                Reset Password
            </button>
        </form>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.toggle-password-btn');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'text') {
                    this.classList.remove('text-slate-400');
                    this.classList.add('text-slate-800');
                } else {
                    this.classList.remove('text-slate-800');
                    this.classList.add('text-slate-400');
                }
            });
        });
    });
</script>