<x-web-layout>
    <x-slot name="title">
        <div class="flex flex-col items-center justify-between mt-0 px-2 py-3">
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{route('lists.index')}}">
                {{ __('My Lists') }}
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto">
        <button id="openModal" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            Nueva lista
        </button>

    </div>

    <div class="container mx-auto grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pt-4 pb-6 mb-6">
        @foreach($lists as $list)
            <div class="p-6 bg-white shadow-lg rounded-lg">
                    <div class="pt-3 flex items-center justify-between">
                        <a href="{{ route('lists.show', $list->id) }}">
                            <p class="">{{ $list->name }}</p>
                        </a>
                        <a href="{{ route('lists.destroy', $list->id) }}">
                            <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M6 7c-.552 0-1 .448-1 1s.448 1 1 1v10c0 1.104.896 2 2 2h8c1.104 0 2-.896 2-2V9c.552 0 1-.448 1-1s-.448-1-1-1h-4V5c0-1.104-.896-2-2-2h-2c-1.104 0-2 .896-2 2v2H6zm4-2h4v2h-4V5zm-2 4h8v10H8V9z"/>
                            </svg>
                        </a>
                    </div>
            </div>
        @endforeach
    </div>


        <!-- Modal (Oculto por defecto) -->
        <div id="modal" class="fixed inset-0 bg-black/50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-xl font-semibold text-gray-800">Lista</h2>

                <!-- Formulario -->
                <form id="modalForm" method="POST" action="{{route("lists.store")}}" class="mt-4">
                    @csrf
                    <div class="mt-4">
                        <label class="block text-gray-700">Nombre:</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Botones -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Crear
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


