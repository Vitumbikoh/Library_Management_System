@extends('admin.layout')

@section('content')


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold mb-4">Manage Books</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required class="block mt-1 w-full" />

                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" value="{{ old('author', $book->author) }}" required class="block mt-1 w-full" />

                            <x-input-label for="publisher" :value="__('Publisher')" />
                            <x-text-input id="publisher" name="publisher" type="text" value="{{ old('publisher', $book->publisher) }}" required class="block mt-1 w-full" />

                            <x-input-label for="year_of_publication" :value="__('Year of Publication')" />
                            <x-text-input id="year_of_publication" name="year_of_publication" type="number" value="{{ old('year_of_publication', $book->year_of_publication) }}" required class="block mt-1 w-full" />

                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" value="{{ old('category', $book->category) }}" required class="block mt-1 w-full" />

                            <x-input-label for="isbn" :value="__('ISBN')" />
                            <x-text-input id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn) }}" required class="block mt-1 w-full" />

                            <x-input-label for="quantity_available" :value="__('Quantity Available')" />
                            <x-text-input id="quantity_available" name="quantity_available" type="number" value="{{ old('quantity_available', $book->quantity_available) }}" required class="block mt-1 w-full" />

                            <!-- <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" required class="block mt-1 w-full" rows="4">{{ old('description', $book->description) }}</x-text-input> -->

                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" value="{{ old('location', $book->location) }}" required class="block mt-1 w-full" />

                            <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
