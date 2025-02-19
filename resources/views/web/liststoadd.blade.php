<x-web-layout>
    <x-slot name="title">
        <div class="flex flex-col items-center justify-between mt-0 px-2 py-3">
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{route('lists.index')}}">
                {{ __('Lists to add') }}
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pt-4 pb-6 mb-6">
        @foreach($lists as $list)
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <a href="{{ route('lists.addgame', [$list->id, $game->id]) }}">
                    <div class="pt-3 flex items-center justify-between">
                        <p class="">{{ $list->name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>



</x-web-layout>


