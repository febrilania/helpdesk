<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('create_response.staff', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="message"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Respon</label>
                            <textarea id="message" name="message" rows="4" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring focus:ring-indigo-200"></textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-800 focus:ring focus:ring-blue-300">
                            Kirim Respon
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
