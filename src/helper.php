<?php
if (!function_exists('get_settings')) {
    /**
     * Get all autoload settings
     */
    function get_settings($keys = null, $groups = null, $autoload = null) {
        $settings = \Mjpakzad\LaravelSettings\Models\Setting::query();
        if($keys !== null) {
            if(is_array($keys)) {
                $settings->whereIn('key', $keys);
            } else {
                $settings->where('key', $keys);
            }
        }
        if($groups !== null) {
            if(is_array($groups)) {
                $settings->whereIn('group', $groups);
            } else {
                $settings->where('group', $groups);
            }
        }
        if($autoload !== null) {
            if($autoload) {
                $settings->autoload();
            } else {
                $settings->manual();
            }
        }
        return $settings->pluck('value', 'key');
    }
}

if (!function_exists('get_setting')) {
    /**
     * Get a specific setting
     */
    function get_setting($key) {
        return \Mjpakzad\LaravelSettings\Models\Setting::where('key', $key)->value('value');
    }
}

if (!function_exists('set_setting')) {
    /**
     * Create a new setting.
     *
     * @return void
     */
    function set_setting($key, $value, $group = null, $autoload = null) {
        $setting = [
            'key'       => $key,
            'value'     => $value,
            'autoload'  => $autoload !== null ? $autoload : false,
        ];
        if($group !== null) {
            $setting['group'] = $group;
        }
        \Mjpakzad\LaravelSettings\Models\Setting::create($setting);
    }
}

if (!function_exists('setting_config')) {
    /**
     * Save settings in config.
     *
     * @return void
     */
    function setting_config($keys = null, $groups = null, $autoload = null) {
        config()->set('settings', get_settings($keys, $groups, $autoload)->toArray());
    }
}

if(!function_exists('settings')) {
    /**
     * Creates a new setting or return settings.
     *
     * @param      $key
     * @param      $value
     * @param null $group
     * @param null $autoload
     *
     * @return \Illuminate\Support\Collection|void
     * @example setting('key'|['',], 'group'|['',], true)
     *
     * @example setting('site_name', 'laravel settings', 'site settings', true) creates a new settings.
     */
    function setting($key, $value, $group = null, $autoload = null) {
        if($autoload !== null) {
            set_setting($key, $value, $group, $autoload);
        } else {
            return get_settings($key, $value, $autoload);
        }
    }
}

if(!function_exists('setting_group')) {
    /**
     * Returns a group of settings.
     *
     * @param array|string $group The name of group or groups
     */
    function setting_group(array|string $group): \Illuminate\Support\Collection
    {
        return get_settings(null, $group);
    }
}

if(!function_exists('setting_autoload')) {
    /**
     * Return autoload or manual settings
     *
     * @param bool $autoload
     *
     * @return \Illuminate\Support\Collection
     */
    function setting_autoload(bool $autoload = true): \Illuminate\Support\Collection
    {
        return get_settings(null, null, $autoload);
    }
}
