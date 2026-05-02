<?php

namespace App\Traits;

use App\Helpers\ColorHelper;

trait ResolvesColors
{
    /**
     * Map hex colors to human-readable Vietnamese names.
     *
     * @param string|null $hex
     * @return string
     */
    public function getColorName($hex = null)
    {
        return ColorHelper::resolve($hex ?: $this->color);
    }

    /**
     * Accessor for color name.
     */
    public function getColorNameAttribute()
    {
        return $this->getColorName();
    }
}
