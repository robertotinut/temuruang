<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $row = static::where('key', $key)->first();
        return $row ? $row->value : $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function getMany(array $defaults): array
    {
        $rows = static::whereIn('key', array_keys($defaults))->pluck('value', 'key')->toArray();
        return array_merge($defaults, $rows);
    }
}
