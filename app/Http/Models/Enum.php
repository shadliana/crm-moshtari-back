<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Enum extends Model
{
    protected $table = 'enum';

    protected $fillable = [
        'name',
        'enum'
    ];
    public static function getEnumNames()
    {
        return self::pluck('name');
    }
}
