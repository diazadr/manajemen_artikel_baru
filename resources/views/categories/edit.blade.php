<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Kategori</h1>
    </x-slot>
    <div class="max-w-3xl mx-auto p-6">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="name" class="block text-sm font-medium text-gray-700">Nama
                    Kategori</x-input-label>
                <input type="text" id="name" name="name"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required value="{{ old('name') ?? $category->name }}">
            </div>
            <x-primary-button type="submit">Edit</x-primary-button>
        </form>
    </div>
</x-app-layout>
