<?php
namespace App\Libraries;

use App\Models\Module;
use App\Models\Setting;

class SiteHelper
{
    public static function get_admin_sidebar_tree()
    {
        
        $modules = Module::with(['sub_modules' => function ($module) {
            $module->where('status', 1)
                ->orderBy('display_order', 'ASC');
        }])->where('status', 1)
            ->where('parent_id', 0);
        $modules = $modules->orderBy('display_order', 'ASC')
            ->withCount(['sub_modules'])
            ->get();
        return $modules;

    }

    public static function getSettingByKey($key)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting;
    }

    public static function getSettingsKeyValue($key)
    {
        $value = '';
        $setting = self::getSettingByKey($key);
        if ($setting) {
            $value = $setting->value;
        }
        return $value;
    }
}
