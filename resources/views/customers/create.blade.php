<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __(($customer->id ? 'Edit' : 'Create') . ' Customer') }}
            </h2>
            <a class="px-4 py-2 text-white text-sm bg-cyan-700 hover:bg-cyan-900 rounded-md border"
                href="{{ route('customers.index') }}">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative overflow-x-auto overflow-hidden shadow-sm sm:rounded-lg">
                <form class="p-6" method="POST"
                    action="{{ $customer->id ? route('customers.update', $customer->id) : route('customers.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($customer->id)
                        @method('PUT')
                    @endif

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $customer->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $customer->email)" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Mobile Number -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Mobile')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone', $customer->phone)" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Org Number -->
                    <div class="mt-4">
                        <x-input-label for="organisation" :value="__('Company')" />
                        <x-text-input id="organisation" class="block mt-1 w-full" type="text" name="organisation"
                            :value="old('organisation', $customer->organisation)" required />
                        <x-input-error :messages="$errors->get('organisation')" class="mt-2" />
                    </div>

                    <!-- Address Number -->
                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-textarea-input id="address" class="block mt-1 w-full" name="address" :value="old('address', $customer->address)" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Photo')" />
                        <div class="flex justify-between items-center">
                            <x-text-input id="image" class="block border p-1 mt-1 flex-1 w-full" type="file"
                                accept="image/*" name="image" />
                            @if ($customer->image)
                                <img class="w-10 h-10 rounded-full ml-4" src="{{ $customer->avatar }}"
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
