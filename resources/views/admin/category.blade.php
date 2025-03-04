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
                        <!-- Tombol untuk membuka modal -->
                        <button type="button"
                            class="btn btn-primary text-white bg-blue-600 mb-3 px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300"
                            id="openModal">
                            Tambah Data
                        </button>

                        <!-- Modal -->
                        <div id="modal"
                            class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center hidden transition-opacity duration-300 ease-in-out">

                            <div class="bg-white text-gray-900 rounded-xl shadow-lg p-6 w-full max-w-md transform scale-95 opacity-0 transition-all duration-300 ease-in-out"
                                id="modalContent">
                                <div class="flex justify-between items-center border-b pb-3">
                                    <h5 class="text-lg font-semibold">Tambah Kategori</h5>
                                    <button type="button"
                                        class="text-gray-500 hover:text-gray-700 transition duration-300"
                                        id="closeModal">
                                        ✕
                                    </button>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ route('add_category') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-4">
                                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama
                                                Kategori</label>
                                            <input type="text" name="name" id="nama"
                                                placeholder="Masukkan nama kategori..."
                                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                        </div>

                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 shadow">
                                                Simpan
                                            </button>
                                            <button type="button"
                                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg ml-2 hover:bg-gray-400 transition duration-300 shadow"
                                                id="closeModal2">
                                                Kembali
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Script untuk modal -->
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const openModal = document.getElementById("openModal");
                                const closeModal = document.getElementById("closeModal");
                                const closeModal2 = document.getElementById("closeModal2");
                                const modal = document.getElementById("modal");
                                const modalContent = document.getElementById("modalContent");

                                openModal.addEventListener("click", function() {
                                    modal.classList.remove("hidden");
                                    setTimeout(() => {
                                        modal.classList.add("opacity-100");
                                        modalContent.classList.remove("scale-95", "opacity-0");
                                        modalContent.classList.add("scale-100", "opacity-100");
                                    }, 10);
                                });

                                function closeModalFunction() {
                                    modalContent.classList.remove("scale-100", "opacity-100");
                                    modalContent.classList.add("scale-95", "opacity-0");
                                    setTimeout(() => {
                                        modal.classList.remove("opacity-100");
                                        modal.classList.add("hidden");
                                    }, 200);
                                }

                                closeModal.addEventListener("click", closeModalFunction);
                                closeModal2.addEventListener("click", closeModalFunction);
                                modal.addEventListener("click", function(e) {
                                    if (e.target === modal) closeModalFunction();
                                });
                            });
                        </script>

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
                                            <!-- Tombol Edit -->
                                            <button
                                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-600 transition duration-300"
                                                onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')">
                                                Edit
                                            </button>

                                            <!-- Modal Edit -->
                                            <div id="editModal"
                                                class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center hidden transition-opacity duration-300 ease-in-out">

                                                <div class="bg-white text-gray-900 rounded-xl shadow-lg p-6 w-full max-w-md transform scale-95 opacity-0 transition-all duration-300 ease-in-out"
                                                    id="editModalContent">

                                                    <div class="flex justify-between items-center border-b pb-3">
                                                        <h5 class="text-lg font-semibold">Edit Kategori</h5>
                                                        <button type="button"
                                                            class="text-gray-500 hover:text-gray-700 transition duration-300"
                                                            id="closeEditModal">
                                                            ✕
                                                        </button>
                                                    </div>

                                                    <div class="mt-4">
                                                        <form id="editCategoryForm" method="POST" action="{{route('update_category', $category->id)}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id" id="editCategoryId">

                                                            <div class="form-group mb-4">
                                                                <label for="editNama"
                                                                    class="block text-sm font-medium text-gray-700">Nama
                                                                    Kategori</label>
                                                                <input type="text" name="name" id="editNama"
                                                                    placeholder="Nama Kategori"
                                                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                                            </div>

                                                            <div class="flex justify-end">
                                                                <button type="submit"
                                                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 shadow">
                                                                    Simpan
                                                                </button>
                                                                <button type="button"
                                                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg ml-2 hover:bg-gray-400 transition duration-300 shadow"
                                                                    id="closeEditModal2">
                                                                    Kembali
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Script untuk modal edit -->
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const editModal = document.getElementById("editModal");
                                                    const editModalContent = document.getElementById("editModalContent");
                                                    const closeEditModal = document.getElementById("closeEditModal");
                                                    const closeEditModal2 = document.getElementById("closeEditModal2");
                                                    const editCategoryForm = document.getElementById("editCategoryForm");
                                                    const editCategoryId = document.getElementById("editCategoryId");
                                                    const editNama = document.getElementById("editNama");

                                                    window.openEditModal = function(id, name) {
                                                        editCategoryId.value = id;
                                                        editNama.value = name;
                                                        editCategoryForm.action = `/admin/category/${id}`;


                                                        editModal.classList.remove("hidden");
                                                        setTimeout(() => {
                                                            editModal.classList.add("opacity-100");
                                                            editModalContent.classList.remove("scale-95", "opacity-0");
                                                            editModalContent.classList.add("scale-100", "opacity-100");
                                                        }, 10);
                                                    };

                                                    function closeEditModalFunction() {
                                                        editModalContent.classList.remove("scale-100", "opacity-100");
                                                        editModalContent.classList.add("scale-95", "opacity-0");
                                                        setTimeout(() => {
                                                            editModal.classList.remove("opacity-100");
                                                            editModal.classList.add("hidden");
                                                        }, 200);
                                                    }

                                                    closeEditModal.addEventListener("click", closeEditModalFunction);
                                                    closeEditModal2.addEventListener("click", closeEditModalFunction);
                                                    editModal.addEventListener("click", function(e) {
                                                        if (e.target === editModal) closeEditModalFunction();
                                                    });
                                                });
                                            </script>



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
