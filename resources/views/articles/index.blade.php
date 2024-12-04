<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Artikel Saya</h1>
    </x-slot>
    <div class="container mx-auto p-6">
        <a href="{{ route('articles.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4 inline-block">Buat Artikel
            Baru</a>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Judul</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Kategori</th>
                        <th class="w-50 px-4 py-2 text-sm font-medium text-gray-600">Konten</th>
                        <th class="w-50 px-4 py-2 text-sm font-medium text-gray-600">Tag</th>
                        <th class="w-50 px-4 py-2 text-sm font-medium text-gray-600">File</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $article->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $article->category->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ Str::limit($article->content, 50) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <ul>
                                    @foreach ($article->tags as $articletag)
                                    <li>
                                        {{ $articletag->tag->name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 text-sm text-blue-500">
                                @if ($article->file_path)
                                    <a href="{{ Storage::url($article->file_path) }}" target="_blank"
                                        class="underline hover:text-blue-700">
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-500">Tidak ada file</span>
                                @endif
                            </td>

                            @canany(['edit articles', 'delete articles'])
                            <td class="px-4 py-2 d-flex">
                                @can('edit articles')
                                <a href="{{ route('articles.edit', $article) }}"
                                    class="bg-yellow-500 text-gray-200 px-3 py-1 rounded-md hover:bg-yellow-600 text-sm">Edit</a>
                                    @endcan
                                    @can('delete articles')
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-gray-200 px-3 py-1 rounded-md hover:bg-red-600 text-sm">Hapus</button>
                                </form>
                                @endcan
                            </td>
                            @endcanany
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
