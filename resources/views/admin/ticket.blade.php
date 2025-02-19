{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ini Halaman Tiket ". Auth::user()->name . " !") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
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
                    {{-- <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Daftar Tiket</h2>
                        <a href="{{ route('get_form_ticket.mahasiswa') }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Tambah Tiket
                        </a>
                    </div> --}}

                    <!-- Tabel Ticket -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 text-black">
                                    <th class="py-2 px-4 border-b text-left">No</th>
                                    <th class="py-2 px-4 border-b text-left">Pembuat Tiket</th>
                                    <th class="py-2 px-4 border-b text-left">Subjek</th>
                                    <th class="py-2 px-4 border-b text-left">Kategori</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                    <th class="py-2 px-4 border-b text-left">Prioritas</th>
                                    <th class="py-2 px-4 border-b text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                        <td class="py-2 px-4">{{ $ticket->user->name }}</td>
                                        <td class="py-2 px-4">{{ $ticket->subject }}</td>
                                        <td class="py-2 px-4">{{ $ticket->category->name }}</td>
                                        <td class="py-2 px-4">
                                            <span
                                                class="px-2 py-1 rounded text-white 
                                                {{ $ticket->status == 'open'
                                                    ? 'bg-green-500'
                                                    : ($ticket->status == 'in_progress'
                                                        ? 'bg-yellow-500'
                                                        : ($ticket->status == 'resolved'
                                                            ? 'bg-blue-500'
                                                            : 'bg-gray-500')) }}">
                                                {{ ucfirst($ticket->status) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 capitalize">{{ $ticket->priority }}</td>
                                        <td class="py-2 px-4 flex space-x-2">
                                            <!-- Tombol Lihat -->

                                            <a href="{{route('detail_ticket.admin', $ticket->id)}}"
                                                class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                Lihat
                                            </a>
                                            <a href="{{route('form_response.admin', $ticket->id)}}"
                                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Response
                                            </a>
                                            <a href="{{route('edit_form_ticket.admin', $ticket->id)}}"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                Ubah Status
                                            </a>
                                            <!-- Tombol Hapus -->
                                            {{-- <form action="{{ route('delete_ticket.', $ticket->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Hapus
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Jika Tidak Ada Tiket -->
                    @if ($tickets->isEmpty())
                        <p class="mt-4 text-center text-gray-400">Tidak ada tiket yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
