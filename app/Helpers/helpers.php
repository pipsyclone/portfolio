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
     * Get safe image URL with fallback to default placeholder
     */
    function safe_image(?string $imagePath, string $default = 'images/default-placeholder.png'): string
    {
        if (! $imagePath) {
            return asset($default);
        }

        // Jika path sudah berupa URL lengkap
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        // Jika menggunakan storage
        if (str_starts_with($imagePath, 'storage/')) {
            return asset($imagePath);
        }

        // Jika path dari Filament storage (tanpa prefix storage/)
        return asset('storage/'.$imagePath);
    }
}
