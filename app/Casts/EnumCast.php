<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class EnumCast implements CastsAttributes
{
    protected string $enumArrayName;

    public function __construct($enumArrayName)
    {
        $this->enumArrayName = $enumArrayName;
    }

    public function get($model, $key, $value, $attributes)
    {
        $enumArray = get_class($model)::${$this->enumArrayName};

        foreach ($enumArray as $enum => $enumValue) {
            if($value === $enumValue){
                return $enum;
            }
        }
        return null;
    }

    public function set($model, $key, $value, $attributes)
    {
        $enumArray = get_class($model)::${$this->enumArrayName};
        if(is_int($value)) {
            if(in_array($value, array_values($enumArray))) {
                return $value;
            } else return null;
        }
        return $enumArray[$value] ?? null;
    }

}
