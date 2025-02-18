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
                    <!-- Tabel Kategori -->
                    <div class="">
                        <h3 class="text-xl font-semibold mb-4">Daftar Kategori</h3>
                        <button type="button" class="btn btn-primary text-white bg-blue-500 px-4 py-2 rounded mb-6"
                            id="openModal">
                            Tambah Data
                        </button>

                        <!-- Modal -->
                        <div id="modal"
                            class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
                            <div class="bg-gray-700 rounded-lg p-6 shadow-xl sm:rounded-lg">
                                <div class="flex justify-between items-center">
                                    <h5 class="text-lg font-semibold" id="exampleModalLabel">Tambah Kategori</h5>
                                    <button type="button" class="text-gray-500" id="closeModal">
                                        <span class="text-2xl">&times;</span>
                                    </button>
                                </div>
                                <div class="my-4">
                                    <form action="{{ route('add_category') }}" method="POST">
                                        @csrf
                                        <div class="form flex flex-col my-5">
                                            <label for="nama">Nama Kategori</label>
                                            <input type="text" name="name" id="nama" placeholder="..."
                                                class="text-black">
                                        </div>

                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                                                id="saveChanges">
                                                Simpan
                                            </button>
                                            <button type="button"
                                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded ml-2 hover:bg-gray-400"
                                                id="closeModal2">
                                                Kembali
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="min-w-full bg-dark border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 text-black">
                                    <th class="py-2 px-4 border-b text-left">Nama Kategori</th>
                                    <th class="py-2 px-4 border-b text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <!-- Tombol Edit -->
                                            <button
                                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                                id="edit-{{ $category->id }}"
                                                onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')">
                                                Edit
                                            </button>

                                            <!-- Modal Edit -->
                                            <div id="editModal"
                                                class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
                                                <div class="bg-gray-700 rounded-lg p-6 shadow-xl sm:rounded-lg">
                                                    <div class="flex justify-between items-center">
                                                        <h5 class="text-lg font-semibold">Edit Kategori</h5>
                                                        <button type="button" class="text-gray-500"
                                                            id="closeEditModal">
                                                            <span class="text-2xl">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="my-4">
                                                        <form id="editCategoryForm"
                                                            action="{{ route('update_category', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id" id="categoryId">
                                                            <div class="form flex flex-col my-5">
                                                                <label for="editNama">Nama Kategori</label>
                                                                <input type="text" name="name" id="editNama"
                                                                    placeholder="Nama Kategori" class="text-black">
                                                            </div>
                                                            <div class="flex justify-end">
                                                                <button type="submit"
                                                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                                    Simpan
                                                                </button>
                                                                <button type="button"
                                                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded ml-2 hover:bg-gray-400"
                                                                    id="closeEditModal2">
                                                                    Kembali
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('delete_category', $category->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
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
    </div>

    <script>
        // Mendapatkan elemen
        const modal = document.getElementById('modal');
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const closeModal2 = document.getElementById('closeModal2');

        // Membuka modal
        openModal.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Menutup modal
        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
        closeModal2.addEventListener('click', () => {
            modal.classList.add('hidden');
        });


        // Mendapatkan elemen modal edit dan tombol close
        const editModal = document.getElementById('editModal');
        const closeEditModal = document.getElementById('closeEditModal');
        const closeEditModal2 = document.getElementById('closeEditModal2');

        // Membuka modal edit dan menampilkan data kategori
        function openEditModal(id, name) {
            document.getElementById('categoryId').value = id;
            document.getElementById('editNama').value = name;
            editModal.classList.remove('hidden');
        }

        // Menutup modal edit
        closeEditModal.addEventListener('click', () => {
            editModal.classList.add('hidden');
        });

        closeEditModal2.addEventListener('click', () => {
            editModal.classList.add('hidden');
        });
    </script>


</x-app-layout>
