<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __(($invoice->id ? 'Edit' : 'Create') . ' Invoice') }}
            </h2>
            <a class="px-4 py-2 text-white text-sm bg-cyan-700 hover:bg-cyan-900 rounded-md border"
                href="{{ route('invoices.index') }}">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative overflow-x-auto overflow-hidden shadow-sm sm:rounded-lg">
                <form class="p-6" method="POST"
                    action="{{ $invoice->id ? route('invoices.update', $invoice->id) : route('invoices.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($invoice->id)
                        @method('PUT')
                    @endif

                    <!-- Customer -->
                    <div class="mt-4">
                        <x-input-label for="customer" :value="__('Customer')" />
                        <x-select id="customer" class="block mt-1 w-full" type="text" name="customer_id" required>
                            <option value="" selected disabled>Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('customer')" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div class="mt-4">
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                            :value="old('date', $invoice->date)" required autofocus />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <!-- Inv_Number -->
                    <div class="mt-4">
                        <x-input-label for="inv_number" :value="__('Invoice Number')" />
                        <x-text-input id="inv_number" class="block mt-1 w-full" type="text" name="inv_number"
                            :value="old('inv_number', $invoice->inv_number)" :readonly="(bool) $invoice->id" />
                        <x-input-error :messages="$errors->get('inv_number')" class="mt-2" />
                    </div>

                    <!-- Notes -->
                    <div class="mt-4">
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-textarea-input id="notes" class="block mt-1 w-full" type="text" name="notes"
                            placeholder="Write something..." :value="old('notes', $invoice->notes)" />
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <x-select id="status" class="block mt-1 w-full" type="text" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <hr class="border-t py-4" />

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-800 mb-4">Products</h2>
                        <div id="product-rows" class="space-y-2">
                            @include('invoices.partials.product')
                        </div>

                        <div class="w-full mt-2 mx-auto text-center border-t pt-2 block">
                            <x-secondary-button id="add-product" type="button">
                                Add New
                            </x-secondary-button>
                        </div>

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

    <script>
        (function() {
            const btn = document.getElementById('add-product');
            const rows = document.getElementById('product-rows');

            btn?.addEventListener('click', async function() {
                const response = await fetch("{{ route('invoices.create.product') }}");
                const result = await response.text();
                const div = document.createElement('div');
                div.innerHTML = result;
                rows.appendChild(div);
            });
        })();

        const productChange = function(evt) {
            const selected = evt.querySelector('option[value="' + evt.value + '"]');
            let priceInp = evt.parentElement.parentElement.querySelector('.price');
            priceInp.value = selected.dataset.price;
        }
    </script>
</x-app-layout>
