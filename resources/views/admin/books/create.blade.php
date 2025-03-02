@extends('admin.layout')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        {{ __('Create Book') }}
                    </h2>

                    <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" required class="block w-full mt-1"
                                placeholder="Enter the book title" />
                        </div>

                        <div>
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" required class="block w-full mt-1"
                                placeholder="Enter the author's name" />
                        </div>

                        <div>
                            <x-input-label for="publisher" :value="__('Publisher')" />
                            <x-text-input id="publisher" name="publisher" type="text" required class="block w-full mt-1"
                                placeholder="Enter the publisher's name" />
                        </div>

                        <div>
                            <x-input-label for="year_of_publication" :value="__('Year of Publication')" />
                            <x-text-input id="year_of_publication" name="year_of_publication" type="number" required
                                class="block w-full mt-1" placeholder="Enter the year of publication" />
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" required class="block w-full mt-1"
                                placeholder="Enter the book category" />
                        </div>

                        <div>
                            <x-input-label for="isbn" :value="__('ISBN')" />
                            <x-text-input id="isbn" name="isbn" type="text" required class="block w-full mt-1"
                                placeholder="Enter the book ISBN" />
                        </div>

                        <div>
                            <x-input-label for="quantity_available" :value="__('Quantity Available')" />
                            <x-text-input id="quantity_available" name="quantity_available" type="number" required
                                class="block w-full mt-1" placeholder="Enter the quantity available" min="1" />
                        </div>


                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="4" placeholder="Enter a description of the book"></textarea>
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" required class="block w-full mt-1"
                                placeholder="Enter the book location" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection