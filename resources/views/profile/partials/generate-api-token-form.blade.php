<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Generate api token') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Generate a new API token to authenticate with the application.') }}
        </p>
    </header>

    <div class="mt-1">
        <x-primary-button
            id="generateToken"
            x-data=""
        >{{ __('Generate token') }}</x-primary-button>

        <p class="mt-2 p-1">Token:
            <span id="tokenOutput" class="italic text-blue-500 font-mono"></span>
        </p>
    </div>
</section>

<script>
    document.getElementById("generateToken").addEventListener("click", function() {
        axios.get("{{ route('generate.token') }}")
            .then(response => {
                document.getElementById("tokenOutput").textContent = response.data.token;
            })
            .catch(error => {
                console.error("Error generando token", error);
            });
    });
</script>
