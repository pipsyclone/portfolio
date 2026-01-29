<?php

use Carbon\Carbon;

if (!function_exists('translated_time')) {
    /**
     * Get human-readable time difference in Indonesian
     *
     * @param string|Carbon|null $datetime
     * @return string
     */
    function translated_time($datetime): string
    {
        if (!$datetime) {
            return '-';
        }

        $carbon = $datetime instanceof Carbon ? $datetime : Carbon::parse($datetime);
        $now = Carbon::now();
        $diff = $carbon->diff($now);

        if ($diff->y > 0) {
            return $diff->y . ' tahun yang lalu';
        }

        if ($diff->m > 0) {
            return $diff->m . ' bulan yang lalu';
        }

        if ($diff->d > 0) {
            if ($diff->d >= 7) {
                $weeks = floor($diff->d / 7);
                return $weeks . ' minggu yang lalu';
            }
            return $diff->d . ' hari yang lalu';
        }

        if ($diff->h > 0) {
            return $diff->h . ' jam yang lalu';
        }

        if ($diff->i > 0) {
            return $diff->i . ' menit yang lalu';
        }

        return 'Baru saja';
    }
}

if (!function_exists('formatted_date')) {
    /**
     * Format date in Indonesian format
     *
     * @param string|Carbon|null $datetime
     * @param string $format
     * @return string
     */
    function formatted_date($datetime, string $format = 'd F Y'): string
    {
        if (!$datetime) {
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
