<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryStorageAdapter as BaseAdapter;

class CloudinaryStorageAdapter extends BaseAdapter
{
    private Cloudinary $cloudinaryInstance;

    public function __construct(Cloudinary $cloudinary, $mimeTypeDetector = null, ?string $prefix = null)
    {
        parent::__construct($cloudinary, $mimeTypeDetector, $prefix);
        $this->cloudinaryInstance = $cloudinary;
    }

    /**
     * Override getUrl untuk langsung generate URL tanpa memanggil Admin API
     * Ini menghindari error "Resource not found" untuk file yang baru diupload
     */
    public function getUrl(string $path): string
    {
        $info = pathinfo($path);
        $extension = strtolower($info['extension'] ?? '');

        // Build public_id (path tanpa extension)
        $dirname = str_replace('\\', '/', $info['dirname'] ?? '');
        if ($dirname === '.' || $dirname === '') {
            $publicId = $info['filename'];
        } else {
            $publicId = $dirname.'/'.$info['filename'];
        }
        $publicId = ltrim($publicId, './\\/');

        // Detect resource type
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'ico', 'avif'];
        $videoExtensions = ['mp4', 'webm', 'mov', 'avi', 'mkv', 'ogv'];

        if (in_array($extension, $imageExtensions)) {
            $type = 'image';
        } elseif (in_array($extension, $videoExtensions)) {
            $type = 'video';
        } else {
            $type = 'raw';
        }

        $cloudName = $this->cloudinaryInstance->configuration->cloud->cloudName;

        return "https://res.cloudinary.com/{$cloudName}/{$type}/upload/{$publicId}.{$extension}";
    }
}
