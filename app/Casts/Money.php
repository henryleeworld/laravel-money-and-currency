<?php

namespace App\Casts;

use Brick\Money\Money as BrickMoney;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Money implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return BrickMoney::ofMinor($attributes['price'], $attributes['currency']);
    }
 
    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return (! $value instanceof BrickMoney) ? $value : $value->getMinorAmount()->toInt();
    }
}
