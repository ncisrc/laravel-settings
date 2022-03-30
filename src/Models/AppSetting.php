<?php

namespace Nci\SettingsPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    public static function all($columns = ['*'])
    {
        return static::query()->where('scope', 'App')->get(
            is_array($columns) ? $columns : func_get_args()
        );
    }
}