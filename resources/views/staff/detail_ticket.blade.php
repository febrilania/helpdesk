<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800 dark:text-gray-200">Detail Tiket
                    </h2>

                    <!-- Detail Tiket -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300">Nama Pelapor:</p>
                            <p class="text-lg">{{ $ticket->user->name }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300">Kategori:</p>
                            <p class="text-lg">{{ $ticket->category->name }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300">Subjek:</p>
                            <p class="text-lg">{{ $ticket->subject }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Status:</p>
                            <span
                                class="px-4 py-2 text-white rounded-full 
                                {{ $ticket->status == 'open' ? 'bg-blue-500' : '' }}
                                {{ $ticket->status == 'in_progress' ? 'bg-yellow-500' : '' }}
                                {{ $ticket->status == 'resolved' ? 'bg-green-500' : '' }}
                                {{ $ticket->status == 'closed' ? 'bg-gray-500' : '' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Prioritas:</p>
                            <span
                                class="px-4 py-2 text-white rounded-full
                                {{ $ticket->priority == 'low' ? 'bg-green-500' : '' }}
                                {{ $ticket->priority == 'medium' ? 'bg-blue-500' : '' }}
                                {{ $ticket->priority == 'high' ? 'bg-yellow-500' : '' }}
                                {{ $ticket->priority == 'urgent' ? 'bg-red-500' : '' }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300">Bagian:</p>
                            <p class="text-lg">{{ $ticket->bagian ? $ticket->bagian->name : '-' }}</p>
                        </div>
                        <div class="col-span-2 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <p class="font-semibold text-gray-700 dark:text-gray-300">Deskripsi:</p>
                            <p class="whitespace-pre-line text-lg">{{ $ticket->description }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Respon</h3>
                    
                        @if ($ticket->responses->count() > 0)
                            <div class="space-y-4">
                                @foreach ($ticket->responses as $response)
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                        <div class="flex justify-between items-center">
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $response->user?->name ?? 'Pengguna Tidak Diketahui' }} - 
                                                <span class="text-xs text-gray-500">{{ $response->created_at->format('d M Y, H:i') }}</span>
                                            </p>
                                            
                                        </div>
                                        <p class="mt-2 text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                            {{ $response->message }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400 italic">Belum ada respon.</p>
                        @endif
                    </div>

                    <!-- Tombol Kembali dan Tombol Respon -->
                    <div class="mt-6 text-center space-x-4">
                        <a href="{{ route('get_ticket.staff') }}"
                            class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                            Kembali
                        </a>
                        <a href="{{route('form_response.staff', $ticket->id)}}"
                            class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                            Respon
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
