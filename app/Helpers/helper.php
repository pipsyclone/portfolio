<?php

if (! function_exists('safe_image_url')) {
    function safe_image_url($path = null, $folder = null)
    {
        $default = asset('images/placeholder.jpg');

        if (empty($path)) {
            return $default;
        }

        // Jika URL lengkap, langsung return
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $path = ltrim($path, '/');

        // Jika path belum mengandung folder (hanya nama file), tambahkan folder
        if ($folder && ! str_contains($path, '/')) {
            $path = trim($folder, '/') . '/' . $path;
        }
        // Jika path sudah mengandung '/', berarti sudah format folder/nama_file — pakai langsung

        $public = \Illuminate\Support\Facades\Storage::disk('public');
        if ($public->exists($path)) {
            return $public->url($path);
        }

        return $default;
    }
}

if (! function_exists('safe_image_urls')) {
    function safe_image_urls($paths = null, $folder = null): array
    {
        if (empty($paths)) {
            return [];
        }

        // Jika masih string (misal data lama belum migrasi ke json)
        if (is_string($paths)) {
            $decoded = json_decode($paths, true);
            $paths = is_array($decoded) ? $decoded : [$paths];
        }

        if (! is_array($paths)) {
            return [];
        }

        return array_values(array_filter(
            array_map(fn ($path) => safe_image_url($path, $folder), $paths)
        ));
    }
}

if (! function_exists('format_bytes')) {
    function format_bytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (! function_exists('get_real_ip')) {
    /**
     * Get real IP address from request, checking various headers
     * This is useful when behind proxies, load balancers, or CDN
     */
    function get_real_ip()
    {
        $request = request();
        
        // Try to get IP from various headers in order of priority
        $headers = [
            'HTTP_CF_CONNECTING_IP',    // Cloudflare
            'HTTP_X_REAL_IP',            // Nginx proxy
            'HTTP_X_FORWARDED_FOR',      // Standard proxy header
            'HTTP_CLIENT_IP',            // Proxy
            'REMOTE_ADDR'                // Direct connection
        ];
        
        foreach ($headers as $header) {
            if ($ip = $request->server($header)) {
                // X-Forwarded-For can contain multiple IPs, get the first one
                if (strpos($ip, ',') !== false) {
                    $ips = explode(',', $ip);
                    $ip = trim($ips[0]);
                }
                
                // Validate IP
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
        
        // Fallback to Laravel's ip() method
        return $request->ip();
    }
}

if (! function_exists('get_location_from_ip')) {
    /**
     * Get location information from IP address using ip-api.com (free, no API key needed)
     * Returns string like: "Jakarta, Indonesia" or "-" if failed
     */
    function get_location_from_ip($ip)
    {
        // Skip for localhost/private IPs
        if (in_array($ip, ['127.0.0.1', '::1', 'localhost']) || empty($ip)) {
            return 'Localhost';
        }

        // Check if it's a private IP range
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return 'Private Network';
        }

        try {
            // Use ip-api.com free service (limit: 45 requests per minute)
            // Added fields: city, regionName, country, timezone, isp
            $response = \Illuminate\Support\Facades\Http::timeout(5)->get("http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,timezone,isp");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 'success') {
                    $city = $data['city'] ?? '';
                    $region = $data['regionName'] ?? '';
                    $country = $data['country'] ?? '';
                    
                    // Format: City, Region, Country or City, Country
                    $location = [];
                    if ($city) $location[] = $city;
                    if ($region && $region !== $city) $location[] = $region;
                    if ($country) $location[] = $country;
                    
                    return !empty($location) ? implode(', ', $location) : '-';
                }
                
                // Log error jika ada
                if (isset($data['message'])) {
                    \Illuminate\Support\Facades\Log::warning('IP Location API Error', [
                        'ip' => $ip,
                        'message' => $data['message']
                    ]);
                }
            } else {
                \Illuminate\Support\Facades\Log::warning('IP Location API Failed', [
                    'ip' => $ip,
                    'status' => $response->status()
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('IP Location Exception', [
                'ip' => $ip,
                'error' => $e->getMessage()
            ]);
        }
        
        return 'Lokasi tidak diketahui';
    }
}

if (! function_exists('fa_access_token')) {
    function fa_access_token()
    {
        return cache()->remember('fa-access-token', 3500, function () {
            $response = Http::withToken(env('FONTAWESOME_API_TOKEN'))
                ->post('https://api.fontawesome.com/token');

            $json = $response->json();

            if (!isset($json['access_token'])) {
                \Log::error('FA token error', $json ?? []);
                return null;
            }

            return $json['access_token'];
        });
    }
}