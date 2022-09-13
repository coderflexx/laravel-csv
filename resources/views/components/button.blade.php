<button
    {{ $attributes }}
    x-data 
    x-on:click="window.livewire.emitTo('csv-importer', 'toggle')">
    {{ $slot }}
</button>