<h2 class="text-xl font-semibold">{{__('Phone number')}}</h2>

<div class="mb-6">
    <x-jet-label for="phone_number" value="{{ __('Phone number') }}" />
    <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number"/>
</div>
