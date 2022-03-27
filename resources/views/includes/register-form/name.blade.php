<h2 class="text-xl font-semibold">{{__('Name')}}</h2>

<div>
    <x-jet-label for="first_name" value="{{ __('First name') }}" />
    <x-jet-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" x-on:change="first_name = $event.target.value"/>
</div>

<div>
    <x-jet-label for="initial" value="{{ __('Initial') }}" />
    <x-jet-input id="initial" class="block mt-1 w-full" type="text" name="initial" required autofocus autocomplete="initial" x-bind:value="'{{old('initial')}}' ?? first_name.charAt(0).toUpperCase()" />
</div>

<div class="mb-6">
    <x-jet-label for="last_name" value="{{ __('Last name') }}" />
    <x-jet-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name"/>
</div>
