<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto p-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] mt-10">
        
        <h2 class="text-3xl font-bold mb-6 text-white tracking-wide text-center">Pemulihan Sandi</h2>

        <div class="text-sm text-gray-200 mb-8 bg-black/30 p-4 rounded-xl border border-white/10">
            <p class="font-semibold mb-2 text-white">Instruksi Pemulihan:</p>
            <ol class="list-decimal list-inside space-y-1">
                <li>Masukkan alamat email yang terdaftar pada sistem.</li>
                <li>Klik tombol "Kirim Tautan".</li>
                <li>Periksa kotak masuk email Anda untuk instruksi lanjutan.</li>
            </ol>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-400 bg-green-900/30 p-3 rounded-lg border border-green-500/30">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-300 mb-2" for="email">
                    Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    class="w-full bg-black/20 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 transition-all backdrop-blur-sm" 
                    required autofocus />
                @error('email')
                    <div class="mt-2 text-red-400 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-row justify-between items-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition-colors px-4 py-2">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                    Kirim Tautan
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>