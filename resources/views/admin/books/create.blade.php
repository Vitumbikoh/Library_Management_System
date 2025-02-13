@extends('admin.layout')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" required class="block mt-1 w-full" />

                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" required class="block mt-1 w-full" />

                            <x-input-label for="publisher" :value="__('Publisher')" />
                            <x-text-input id="publisher" name="publisher" type="text" required class="block mt-1 w-full" />

                            <x-input-label for="year_of_publication" :value="__('Year of Publication')" />
                            <x-text-input id="year_of_publication" name="year_of_publication" type="number" required class="block mt-1 w-full" />

                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" required class="block mt-1 w-full" />

                            <x-input-label for="isbn" :value="__('ISBN')" />
                            <x-text-input id="isbn" name="isbn" type="text" required class="block mt-1 w-full" />

                            <x-input-label for="quantity_available" :value="__('Quantity Available')" />
                            <x-text-input id="quantity_available" name="quantity_available" type="number" required class="block mt-1 w-full" />

                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" required class="block mt-1 w-full" rows="4"></x-text-input>

                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" required class="block mt-1 w-full" />

                            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
