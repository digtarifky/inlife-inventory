<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-medium">Nama Kategori</span>
                        </label>
                        <input type="text" name="name" class="input input-bordered w-full @error('name') input-error @enderror" value="{{ old('name') }}" placeholder="Contoh: Elektronik, Furniture" required />
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('categories.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>