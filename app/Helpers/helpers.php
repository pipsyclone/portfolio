<?php

use Carbon\Carbon;

if (! function_exists('translated_time')) {
    /**
     * Get human-readable time difference in Indonesian
     *
     * @param  string|Carbon|null  $datetime
     */
    function translated_time($datetime): string
    {
        if (! $datetime) {
            return '-';
        }

        $carbon = $datetime instanceof Carbon ? $datetime : Carbon::parse($datetime);
        $now = Carbon::now();
        $diff = $carbon->diff($now);

        if ($diff->y > 0) {
            return $diff->y.' tahun yang lalu';
        }

        if ($diff->m > 0) {
            return $diff->m.' bulan yang lalu';
        }

        if ($diff->d > 0) {
            if ($diff->d >= 7) {
                $weeks = floor($diff->d / 7);

                return $weeks.' minggu yang lalu';
            }

            return $diff->d.' hari yang lalu';
        }

        if ($diff->h > 0) {
            return $diff->h.' jam yang lalu';
        }

        if ($diff->i > 0) {
            return $diff->i.' menit yang lalu';
        }

        return 'Baru saja';
    }
}

if (! function_exists('formatted_date')) {
    /**
     * Format date in Indonesian format
     *
     * @param  string|Carbon|null  $datetime
     */
    function formatted_date($datetime, string $format = 'd F Y'): string
    {
        if (! $datetime) {
            return '-';
        }

        $carbon = $datetime instanceof Carbon ? $datetime : Carbon::parse($datetime);

        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $formatted = $carbon->format($format);
        $formatted = str_replace(array_keys($months), array_values($months), $formatted);
        $formatted = str_replace(array_keys($days), array_values($days), $formatted);

        return $formatted;
    }
}

if (! function_exists('safe_image')) {
    /**
     * Get Cloudinary image URL from filename stored in database
     * Database stores only filename (e.g., 'y69GfdVzJ0bu1Ih7cBmAGbapwfehoggDUSAdkMG6.jpg')
     *
     * @param  string|null  $fileName  Nama file dari database
     * @param  string  $type  Jenis/folder: 'profile', 'projects', 'portfolio'
     */
    function safe_image(
        ?string $fileName,
        string $type = 'profile',
        string $default = 'images/default-placeholder.png'
    ): string {
        // Jika tidak ada file
        if (empty($fileName) || trim($fileName) === '') {
            return asset($default);
        }

        // Jika sudah URL lengkap, langsung return
        if (filter_var($fileName, FILTER_VALIDATE_URL)) {
            return $fileName;
        }

        // Cloudinary configuration
        $cloudName = env('CLOUDINARY_CLOUD_NAME', 'dh5tajrlv');

        // Hapus ekstensi untuk mendapatkan public_id
        $publicId = pathinfo($fileName, PATHINFO_FILENAME);

        // Mapping folder berdasarkan type (sesuai struktur Cloudinary Anda)
        $folders = [
            'profile' => 'portfolio/profile',
            'projects' => 'portfolio/projects',
            'portfolio' => 'portfolio',
            // Tambahkan mapping lain sesuai kebutuhan
        ];

        $folder = $folders[$type] ?? 'portfolio';

        // Generate Cloudinary URL
        // Format: https://res.cloudinary.com/CLOUD_NAME/image/upload/FOLDER/PUBLIC_ID
        return "https://res.cloudinary.com/{$cloudName}/image/upload/{$folder}/{$publicId}";
    }
}
