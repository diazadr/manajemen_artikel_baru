<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800 ">Category</h1>
    </x-slot>
    <div class="container mx-auto p-6">
        <a href="{{ route('categories.create') }}"
            class="bg-gray-800 dark:bg-blue-600 text-gray-800 dark:text-white px-4 py-2 rounded-md hover:bg-blue-700 mb-4 inline-block">Buat
            Kategori Baru</a>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Nama
                            Kategori</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $category->name }}</td>
                            <td class="px-4 py-2 flex">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="bg-yellow-500 text-gray-200 px-3 py-1 rounded-md hover:bg-yellow-600 text-sm mr-2">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-gray-200 px-3 py-1 rounded-md hover:bg-red-600 text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
