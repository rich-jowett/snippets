<?php

/**
 * Snippet.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */

declare(strict_types=1);

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Snippet
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App
 */
class Snippet extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = ['code', 'created_by'];
}
