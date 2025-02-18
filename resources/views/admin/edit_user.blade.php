<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Edit User</h2>

                    <!-- Form Edit -->
                    <form action="{{ route('update_user', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-2 border rounded text-gray-900 dark:text-gray-800">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block font-medium">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-2 border rounded text-gray-900 dark:text-gray-800">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password (Opsional) -->
                        <div class="mb-4">
                            <label for="password" class="block font-medium">Password (Kosongkan jika tidak ingin
                                mengubah)</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 border rounded text-gray-900 dark:text-gray-800">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block font-medium">Role</label>
                            <select name="role" id="role"
                                class="w-full px-4 py-2 border rounded text-gray-900 dark:text-gray-800">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                </option>
                            </select>
                            @error('role')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('get_user') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
