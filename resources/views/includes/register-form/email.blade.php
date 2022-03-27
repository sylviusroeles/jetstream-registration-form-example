<h2 class="text-xl font-semibold">{{ __('Email') }}</h2>

<div class="mt-4 mb-6">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
</div>
