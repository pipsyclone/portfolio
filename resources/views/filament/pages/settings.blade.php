<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div style="margin-top: 15px;">
            <x-filament::button type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Simpan Pengaturan</span>
                <span wire:loading wire:target="save">
                    <x-filament::loading-indicator />
                    Menyimpan...
                </span>
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
