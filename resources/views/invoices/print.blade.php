<x-print-layout>
    <div class="py-12 print:p-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 print:max-w-full print:p-0 print:m-0">
            <div
                class="bg-white dark:bg-gray-800 border rounded-lg shadow-lg px-6 py-8 max-w-md print:max-w-full mx-auto mt-8">
                <h1 class="font-bold text-2xl mb-6 text-center text-blue-600 dark:text-blue-400">{{ config('app.name') }}
                </h1>
                <hr class="mb-2">
                <div class="flex justify-between mb-6">
                    <h1 class="text-lg font-bold dark:text-white">Invoice</h1>
                    <div class="text-gray-700 dark:text-gray-300">
                        <div>Date: {{ $invoice->date->format('d/m/Y') }}</div>
                        <div>Invoice #: {{ $invoice->inv_number }}</div>
                    </div>
                </div>
                <div class="mb-8">
                    <h2 class="text-lg font-bold dark:text-white mb-4">Bill To:</h2>
                    <div class="text-gray-700 dark:text-gray-300 mb-2">{{ $invoice->customer->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 mb-2 w-1/2">{{ $invoice->customer->address }}</div>
                    <div class="text-gray-700 dark:text-gray-300">{{ $invoice->customer->email }}</div>
                </div>
                <table class="w-full mb-8">
                    <thead>
                        <tr>
                            <th class="text-left font-bold text-gray-700 dark:text-gray-300">Description</th>
                            <th class="text-right font-bold text-gray-700 dark:text-gray-300">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->products as $item)
                            <tr>
                                <td class="text-left text-gray-700 dark:text-gray-300">
                                    {{ $item->name }}
                                    <span class="text-red-600 text-sm ml-2">
                                        ({{ "{$invoice->currency}{$item->pivot->price} x {$item->pivot->quantity}" }})
                                    </span>
                                </td>
                                <td class="text-right text-gray-700 dark:text-gray-300">
                                    {{ $invoice->currency }}{{ $item->pivot->price * $item->pivot->quantity }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-left border-t font-bold text-gray-700 dark:text-gray-300">Total</td>
                            <td class="text-right border-t font-bold text-gray-700 dark:text-gray-300">
                                {{ $invoice->currency }}{{ $invoice->total_amount }}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="text-gray-700 dark:text-gray-300 mb-2">Thank you for your business!</div>
                <div class="text-gray-700 dark:text-gray-300 text-sm">Please remit payment within 30 days.</div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            window.print();
        })();
    </script>
</x-print-layout>
