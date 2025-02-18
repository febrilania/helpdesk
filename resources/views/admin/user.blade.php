<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h2 class="text-lg font-semibold mb-4">Daftar Pengguna</h2>

                    
                    <div class="mb-4">
                        <a href="{{route('form_add_user')}}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            + Tambah User
                        </a>
                    </div>

                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Role</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr class="bg-gray-100 dark:bg-gray-900">
                                    <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('edit_user', $user->id) }}"
                                            class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('delete_user', $user->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
