<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Edit Tiket</h2>

                    <form action="{{route('ubah_status.staff', $ticket->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium">User</label>
                            <input type="text" value="{{ $ticket->user->name }}" class="w-full p-2 border rounded bg-gray-200 text-black" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Kategori</label>
                            <input type="text" value="{{ $ticket->category->name }}" class="w-full p-2 border rounded bg-gray-200 text-black" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Subjek</label>
                            <input type="text" value="{{ $ticket->subject }}" class="w-full p-2 border rounded bg-gray-200 text-black" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Deskripsi</label>
                            <textarea class="w-full p-2 border rounded bg-gray-200 text-black" disabled>{{ $ticket->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Prioritas</label>
                            <input type="text" value="{{ ucfirst($ticket->priority) }}" class="w-full p-2 border rounded bg-gray-200 text-black" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Status</label>
                            <select name="status" class="w-full p-2 border rounded bg-white text-black">
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <div class="mt-4 flex space-x-4">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-40 text-center">Update Tiket</button>
                            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-6 py-2 rounded w-40 text-center text-center flex items-center justify-center">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
