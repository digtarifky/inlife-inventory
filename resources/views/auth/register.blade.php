<x-guest-layout>
    <!-- Kontainer Luar Sesuai Estetika Gambar 2 -->
    <div
        class="max-w-md w-full mx-auto bg-white p-8 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.04)] border border-slate-100/50">

        <!-- Ikon Aplikasi Terpusat -->
        <div class="flex justify-center mb-6">
            <div
                class="w-14 h-14 bg-gradient-to-br from-slate-700 to-slate-900 rounded-2xl flex items-center justify-center shadow-inner">
                <div class="grid grid-cols-2 gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-white/40"></div>
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white/40"></div>
                </div>
            </div>
        </div>

        <!-- Judul & Deskripsi Instruksional yang Tegas -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Register</h2>
            <p class="text-sm text-slate-400 mt-1.5">Please fill in the details to register.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </span>
                    <input id="name"
                        class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all duration-200"
                        type="text" name="name" placeholder="Full Name" :value="old('name')" required
                        autofocus />
                </div>
                @error('name')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615m19.5 0A2.25 2.25 0 0 0 19.5 6.75" />
                        </svg>
                    </span>
                    <input id="email"
                        class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all duration-200"
                        type="email" name="email" placeholder="Email" :value="old('email')" required />
                </div>
                @error('email')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v-6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <input id="password"
                        class="block w-full pl-12 pr-12 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all duration-200"
                        type="password" name="password" placeholder="Password" required />
                </div>
                @error('password')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v-6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <input id="password_confirmation"
                        class="block w-full pl-12 pr-12 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all duration-200"
                        type="password" name="password_confirmation" placeholder="Confirm Password" required />
                </div>
                @error('password_confirmation')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pilihan Role (Dropdown Select Modern) -->
            <div class="mb-4">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <!-- Ikon Kunci/Akses Sederhana -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v-6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <select id="role_id" name="role_id"
                        class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 border-transparent focus:border-slate-200 focus:bg-white focus:ring-0 rounded-2xl text-sm text-slate-500 transition-all duration-200"
                        required>
                        <option value="" disabled selected>Select Role/Position</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" class="text-slate-700"
                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('role_id')
                    <span class="text-xs text-red-500 mt-1 block pl-2 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Sign Up -->
            <button type="submit"
                class="w-full py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-2xl transition-all duration-200 shadow-sm">
                Sign Up
            </button>
        </form>

        <!-- Tautan Sign In -->
        <div class="mt-8 text-center text-sm text-slate-400">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-slate-700 hover:underline ml-1">Sign In</a>
        </div>
    </div>
</x-guest-layout>
