<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected ?string $oldImage = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            // Penghapusan gambar sudah ditangani di model event
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Simpan gambar lama untuk perbandingan nanti
        $this->oldImage = $data['image'] ?? null;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Extract filename saja untuk image
        if (!empty($data['image'])) {
            $data['image'] = is_array($data['image']) 
                ? basename($data['image'][array_key_first($data['image'])] ?? '') 
                : basename($data['image']);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // Hapus gambar lama dari Cloudinary jika berbeda dengan yang baru
        $newImage = $this->record->image;
        
        if ($this->oldImage && $this->oldImage !== $newImage) {
            $this->deleteFromCloudinary($this->oldImage);
        }
    }

    /**
     * Hapus file dari Cloudinary
     */
    protected function deleteFromCloudinary(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        try {
            $path = "portfolio/projects/{$filename}";
            Storage::disk('cloudinary')->delete($path);
        } catch (\Exception $e) {
            Log::warning("Failed to delete project image from Cloudinary: {$filename}", [
                'error' => $e->getMessage()
            ]);
        }
    }
}
