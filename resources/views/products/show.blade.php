<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('View Product') }}
            </h2>
            <a class="px-4 py-2 text-white text-sm bg-cyan-700 hover:bg-cyan-900 rounded-md border"
                href="{{ route('products.index') }}">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative overflow-x-auto overflow-hidden shadow-sm sm:rounded-lg p-6">

                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3">
                        <img class="w-20 h-20 rounded-full mb-4" src="{{ $product->avatar }}" alt="Image" />
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Name</dt>
                        <dd class="text-lg font-semibold">{{ $product->name }}</dd>
                    </div>
                    <div class="flex flex-col pb-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Brand Name</dt>
                        <dd class="text-lg font-semibold">{{ $product->brand }}</dd>
                    </div>
                    <div class="flex flex-col pb-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Product Price</dt>
                        <dd class="text-lg font-semibold">{{ $product->unit_price }}</dd>
                    </div>
                    <div class="flex flex-col pb-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Quantity</dt>
                        <dd class="text-lg font-semibold">{{ $product->pre_quantity }}</dd>
                    </div>
                    <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Available</dt>
                        <dd class="text-lg font-semibold">{{ $product->available }}</dd>
                    </div>
                </dl>

            </div>
        </div>
    </div>
</x-app-layout>
