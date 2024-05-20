<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product list') }}
            </h2>
            <a class="px-4 py-2 text-white text-sm bg-cyan-700 hover:bg-cyan-900 rounded-md border"
                href="{{ route('products.create') }}">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative overflow-x-auto overflow-hidden shadow-sm sm:rounded-lg">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Unit_Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pre_Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Available
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{-- Action --}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" src="{{ $product->avatar }}"
                                        alt="{{ $product->name }}">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $product->name }}</div>
                                        <div class="font-normal text-gray-500">{{ $product->brand }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->unit_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->pre_quantity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->available }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')"
                                        class="inline-flex rounded-md shadow-sm" role="group">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                            View
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-white border-y border-gray-200 hover:bg-gray-100 hover:text-yellow-700 focus:z-10 focus:ring-2 focus:ring-yellow-700 focus:text-yellow-700">
                                            Edit
                                        </a>
                                        <button type="submit"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700">
                                            Delete
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
</x-app-layout>
