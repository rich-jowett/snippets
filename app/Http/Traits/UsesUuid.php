<?php

/**
 * UsesUuid.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */
declare(strict_types=1);

namespace App\Http\Traits;

use Illuminate\Support\Str;

/**
 * Trait UsesUuid
 *
 * @package App\Http\Traits
 */
trait UsesUuid
{
    protected static function bootUsesUuid() {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
