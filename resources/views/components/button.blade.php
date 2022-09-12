<button
    {{ $attributes }}
    x-data 
    x-on:click="window.livewire.emitTo('csv-importer', 'toogle')">
    {{ $slot }}
</button>