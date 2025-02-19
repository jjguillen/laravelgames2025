<x-web-layout>
    <x-slot name="title">
        <div class="flex flex-col items-center justify-between mt-0 px-2 py-3">
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{route('lists.index')}}">
                {{ __('My Lists') }}
            </a>
        </div>
    </x-slot>


    <div class="container mx-auto flex flex-row gap-6 pt-4 pb-6 mb-6">
            <div class="ms-4 justify-right w-full">
                <h2 class="text-xl font-semibold text-orange-600">{{$list->name}}</h2>
            </div>
    </div>

    <div class="container mx-auto grid grid-cols-2 gap-6 pt-4 pb-6 mb-6 ps-4 pe-4">
        @foreach($list->games as $game)
            <div class="border-b pb-4 w-full gap-2">
                <a href="{{ route('games.show', $game->id) }}">
                    <div class="flex justify-between items-center space-x-4 p-1">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $game->image }}" alt="{{ $game->name }}" class="w-12 h-12 object-cover">
                            <div>
                                <p class="text-lg font-semibold text-gray-700">{{$game->name}}</p>
                                <p class="text-gray-600">{{$game->platform}}</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{route('lists.removegame', [$list->id, $game->id])}}">
                                <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M6.225 6.225a1 1 0 011.414 0L12 10.586l4.361-4.361a1 1 0 111.414 1.414L13.414 12l4.361 4.361a1 1 0 11-1.414 1.414L12 13.414l-4.361 4.361a1 1 0 11-1.414-1.414L10.586 12 6.225 7.639a1 1 0 010-1.414z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>





</x-web-layout>
