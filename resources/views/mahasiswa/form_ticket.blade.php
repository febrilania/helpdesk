<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-4">Tambah Tiket</h2>

                    <!-- Form Add Ticket -->
                    <form action="{{route('add_ticket.mahasiswa')}}" method="POST">
                        @csrf

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-500">Kategori</label>
                            <select name="category_id" id="category"
                                class="mt-1 block w-full text-sm rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-black">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subjek -->
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-500">Subjek</label>
                            <input type="text" name="subject" id="subject" placeholder="Masukkan subjek tiket"
                                class="mt-1 block w-full text-sm rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-black"
                                required>
                            @error('subject')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-500">Deskripsi</label>
                            <textarea name="description" id="description" placeholder="Masukkan deskripsi tiket" rows="4"
                                class="mt-1 block w-full text-sm rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-black"
                                required></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-500">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full text-sm rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-black">
                                <option value="open">Open</option>
                                <option value="in_progress">In Progress</option>
                                <option value="resolved">Resolved</option>
                                <option value="closed">Closed</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prioritas -->
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-500">Prioritas</label>
                            <select name="priority" id="priority"
                                class="mt-1 block w-full text-sm rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-black">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                            @error('priority')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Simpan Tiket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
