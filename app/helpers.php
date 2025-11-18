<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $settings = null;
        
        if ($settings === null) {
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        }
        
        return $settings[$key] ?? $default;
    }
}
