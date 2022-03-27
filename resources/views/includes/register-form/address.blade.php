<h2 class="text-xl font-semibold">{{__('Address')}}</h2>

<div>
    <x-jet-label for="zip_code" value="{{ __('Postal code') }}" />
    <x-jet-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code')" required autofocus autocomplete="postal_code"/>
</div>

<div class="mb-6">
    <x-jet-label for="house_number" value="{{ __('House number') }}" />
    <x-jet-input id="house_number" class="block mt-1 w-full" type="text" name="house_number" :value="old('house_number')" required autofocus autocomplete="house_number"/>
</div>
