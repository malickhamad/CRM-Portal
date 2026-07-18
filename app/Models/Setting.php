<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['group', 'key', 'value'];

    /**
     * Get a setting value by key.
     */
    // public static function get($key, $default = null)
    // {
    //     return self::where('key_name', $key)->value('value') ?? $default;
    // }

    // /**
    //  * Update or create a setting.
    //  */
    // public static function set($key, $value, $group = null)
    // {
    //     return self::updateOrCreate(
    //         ['key_name' => $key],
    //         ['value' => $value, 'group_name' => $group]
    //     );
    // }
}
