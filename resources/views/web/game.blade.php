<x-web-layout>
    <x-slot name="title">
        <div class="flex flex-col items-center justify-between mt-0 px-2 py-3">
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{route('games.index')}}">
                {{ __('Games') }}
            </a>
        </div>
    </x-slot>


    <div class="container mx-auto flex flex-row gap-6 pt-4 pb-6 mb-6">
        <div class="bg-white rounded-lg shadow-lg p-4 flex">
            <div class="justify-center w-1/3">
                <img src="{{ asset($game->image) }}" alt="game" class="object-cover rounded-lg">
            </div>
            <div class="ms-4 justify-right w-2/3">
                <h2 class="text-xl font-semibold text-gray-800">{{$game->name}}</h2>
                <p class="mt-2 text-gray-600">{{$game->description}}</p>
                <p class="mt-2 text-gray-600">
                    <span class="text-orange-600 font-semibold underline decoration-dashed">{{ strtoupper($game->platform) }} - {{ strtoupper($game->genre) }}</span>
                </p>
                <p class="mt-2 text-gray-600">
                    <span class="text-orange-600 font-semibold underline decoration-dashed">Developer: </span>
                    {{$game->developer}} -
                    <span class="text-orange-600 font-semibold underline decoration-dashed">Release date: </span>
                    {{$game->release_date}}
                </p>
                <p class="mt-2 text-gray-600"><span class="text-orange-600 font-semibold underline decoration-dashed">Price: </span>{{$game->price}} €</p>
                <p class="mt-2 text-blue-600"><span class="text-orange-600 font-semibold underline decoration-dashed">Trailer: </span>
                    <a href="{{$game->trailer_url}}">view</a>
                </p>
                <div class="mt-4">
                    @if (!$userReview)
                        <button id="openModal" class="text-indigo-600 hover:text-indigo-800">Review</button>
                    @else
                        <p class="text-gray-600">You have already reviewed this game</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto grid grid-cols-2 gap-6 pt-4 pb-6 mb-6 ps-4 pe-4">
        @foreach($game->reviews as $review)
        <div class="border-b pb-4 w-full gap-2">
            <div class="items-center space-x-4">
                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.945 10.945 0 0112 15c2.49 0 4.774.805 6.879 2.16M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM12 21c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z" />
                </svg>

                <div>
                    <p class="text-lg font-semibold text-gray-700">{{$review->user->name}}</p>
                </div>
            </div>

            <!-- Puntuación -->
            <div class="mt-2 items-center">
                <span class="text-yellow-400 text-xl">
                    @for ($i = 1; $i <= $review->rating; $i++)
                        ★
                    @endfor
                    @for ($i = $review->rating + 1; $i <= 5; $i++)
                        ☆
                    @endfor
                </span> <!-- Cambia según la puntuación -->
                <span class="text-gray-600 ml-2">({{$review->rating}}/5)</span>
            </div>

            <!-- Comentario -->
            <p class="mt-3 text-gray-700">
                {{$review->comment}}
            </p>
        </div>
        @endforeach

    </div>


    <!-- Modal (Oculto por defecto) -->
    <div id="modal" class="fixed inset-0 bg-black/50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-semibold text-gray-800">Review</h2>

            <!-- Formulario -->
            <form id="modalForm" method="POST" action="/games/review/{{$game->id}}" class="mt-4">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="mt-4">
                    <label class="block text-gray-700">Comment:</label>
                    <textarea name="comment"
                              id="comment"
                              class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-blue-300"
                              placeholder="Write your review here..."
                              required>
                    </textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700">Rating:</label>
                    <input type="range" min="1" max="5" name="rating" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Botones -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para abrir/cerrar el modal -->
    <script>
        const modal = document.getElementById('modal');
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const modalForm = document.getElementById('modalForm');
        const comment = document.getElementById('comment');

        // Mostrar el modal
        openModal.addEventListener('click', () => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
        });

        // Cerrar el modal
        closeModal.addEventListener('click', () => {
            modal.classList.add('opacity-0', 'pointer-events-none');
        });

        // Cerrar al hacer clic fuera del contenido
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        // Manejar el submit (evita que la página recargue en pruebas)
        modalForm.addEventListener('submit', (e) => {
            //e.preventDefault(); // Quitar esto cuando conectes con backend
            //alert('Formulario enviado');
            modal.classList.add('opacity-0', 'pointer-events-none');
        });

        // Colocar el cursor al inicio del textarea al abrir el modal
        comment.addEventListener("click", function() {
            let textarea = document.getElementById("comment");
            textarea.setSelectionRange(0, 0); // Coloca el cursor al inicio
            textarea.focus(); // Enfoca el textarea
        });
    </script>


</x-web-layout>
