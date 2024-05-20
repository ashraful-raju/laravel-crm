<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customer list') }}
            </h2>
            <a class="px-4 py-2 text-white text-sm bg-cyan-700 hover:bg-cyan-900 rounded-md border"
                href="{{ route('customers.create') }}">
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
                                Customer name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Organisation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{-- Action --}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" src="{{ $customer->avatar }}"
                                        alt="{{ $customer->name }}">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $customer->name }}</div>
                                        <div class="font-normal text-gray-500">{{ $customer->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $customer->phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $customer->organisation }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $customer->address }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')"
                                        class="inline-flex rounded-md shadow-sm" role="group">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('customers.show', $customer->id) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                            View
                                        </a>
                                        <a href="{{ route('customers.edit', $customer->id) }}"
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
