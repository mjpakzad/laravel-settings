<?php

namespace Mjpakzad\LaravelSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method string group()
 * @method string groups()
 * @method string manual()
 * @method string autoload()
 */
class Setting extends Model
{
    use HasFactory;

    public const MANUAL     = false;
    public const AUTOLOAD   = true;

    protected $fillable = ['key', 'value', 'group', 'autoload'];

    public function scopeGroup($query, $group)
    {
        return $query->whereGroup($group);
    }

    public function scopeGroups($query, $groups)
    {
        return $query->whereIn('group', $groups);
    }

    public function scopeManual($query)
    {
        return $query->whereAutoload(self::MANUAL);
    }

    public function scopeAutoload($query)
    {
        return $query->whereAutoload(self::AUTOLOAD);
    }
}
