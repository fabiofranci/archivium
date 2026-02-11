<x-filament::page class="min-h-screen flex items-center justify-center bg-[#F3F6FB]">

    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <img 
                src="{{ asset('images/archivium-logo.svg') }}" 
                alt="Archivium" 
                class="h-14 mx-auto mb-4"
            >

            <h1 class="text-2xl font-semibold text-gray-800">
                Accesso al sistema
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Archivium – Gestione Archivio Digitale
            </p>
        </div>

        <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8">

            {{ $this->form }}

        </div>

        <div class="text-center mt-6 text-xs text-gray-400">
            © {{ date('Y') }} Archivium
        </div>

    </div>

</x-filament::page>
