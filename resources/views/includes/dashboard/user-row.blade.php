<tr>
    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
        <div class="flex items-center">
            <div class="h-10 w-10 flex-shrink-0">
                <img class="h-10 w-10 rounded-full" src="{{$user->profile_photo_url}}" alt="">
            </div>
            <div class="ml-4">
                <div class="font-medium text-gray-900">{{$user->name}}</div>
                <div class="text-gray-500">{{$user->email}}</div>
                <div class="text-gray-500">{{$user->phone_number}}</div>
            </div>
        </div>
    </td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
        <div>
            {{$user->address['street']}}, {{$user->address['number']}}
        </div>
        <div>
            {{$user->address['postcode']}} {{$user->address['city']}}
        </div>
        @isset($user->address['location'])
            <a target="_blank" class="text-blue-500 hover:text-blue-800 underline" href="https://www.google.com/maps/search/?api=1&query={{$user->address['location']['coordinates'][1] ?? 0}},{{$user->address['location']['coordinates'][0] ?? 0}}">Google maps</a>
        @endif
    </td>
</tr>
