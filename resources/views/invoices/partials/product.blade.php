<div class="flex items-center justify-evenly item">
    <div class="w-1/2 flex-1 mr-1">
        <x-input-label for="product_id" :value="__('Product')" />
        <x-select onchange="productChange(this)" id="product_id" class="w-full mt-1 product-inp" name="products_id[]">
            <option disabled selected value="">Select Product</option>
            @foreach ($products as $item)
                <option data-price="{{ $item->unit_price }}" value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
    </div>
    <div class="w-1/4 mr-1">
        <x-input-label for="quantity" :value="__('Quantity')" />
        <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="products_quantity[]"
            :value="old('quantity', 1)" required />
        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
    </div>
    <div class="w-1/4">
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" class="block price mt-1 w-full" type="text" name="products_price[]"
            :value="old('price')" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>
</div>
