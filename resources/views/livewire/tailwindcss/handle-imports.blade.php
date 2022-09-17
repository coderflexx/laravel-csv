<div wire:poll.2s.visible>
    {{-- For each import --}}
    @foreach ($this->imports as $import)
        <div class="p-6">
            <div>
                <h2 class="font-medium">
                    {{ __('Importing :file_name', [
                        'file_name' => $import->file_name,
                    ]) }}
                </h2>
                <span class="text-gray-700 text-sm">Imported {{ $import->processed_rows }}/{{ $import->total_rows }} rows</span>
                <div class="w-full bg-indigo-100 rounded">
                    <div class="mt-2 w-full bg-indigo-500 rounded h-2" style="width: {{ $import->percentageComplete() }}%"></div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Endforeach import --}}
</div>
