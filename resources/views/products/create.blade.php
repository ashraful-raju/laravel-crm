<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __(($product->id ? 'Edit' : 'Create') . ' Product') }}
            </h2>
            <a class="px-4 py-2 text-white text-sm bg-cyan-700 hover:bg-cyan-900 rounded-md border"
                href="{{ route('products.index') }}">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative overflow-x-auto overflow-hidden shadow-sm sm:rounded-lg">
                <form class="p-6" method="POST"
                    action="{{ $product->id ? route('products.update', $product->id) : route('products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($product->id)
                        @method('PUT')
                    @endif

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $product->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Brand Name -->
                    <div class="mt-4">
                        <x-input-label for="brand" :value="__('Brand')" />
                        <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand"
                            :value="old('brand', $product->brand)" required />
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <!-- Unite Price -->
                    <div class="mt-4">
                        <x-input-label for="unit_price" :value="__('Unit Price')" />
                        <x-text-input id="unit_price" class="block mt-1 w-full" type="text" name="unit_price"
                            :value="old('unit_price', $product->unit_price)" required />
                        <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                    </div>

                    <!-- Old Quantity -->
                    <div class="mt-4">
                        <x-input-label for="pre_quantity" :value="__('Pre Quantity')" />
                        <x-text-input id="pre_quantity" class="block mt-1 w-full" type="text" name="pre_quantity"
                            :value="old('pre_quantity', $product->pre_quantity)" required />
                        <x-input-error :messages="$errors->get('pre_quantity')" class="mt-2" />
                    </div>

                    <!-- Availability -->
                    <div class="mt-4">
                        <x-input-label for="available" :value="__('Available')" />
                        <x-text-input id="available" class="block mt-1 w-full" type="text" name="available"
                            :value="old('available', $product->available)" required />
                        <x-input-error :messages="$errors->get('available')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Photo')" />
                        <div class="flex justify-between items-center">
                            <x-text-input id="image" class="block border p-1 mt-1 flex-1 w-full" type="file"
                                accept="image/*" name="image" />
                            @if ($product->image)
                                <img class="w-10 h-10 rounded-full ml-4" src="{{ $product->avatar }}"
                                    alt="Uploaded Image">
                            @endif
                        </div>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
