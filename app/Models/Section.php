<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */

class Section extends Model
{
    use HasFactory;

    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
