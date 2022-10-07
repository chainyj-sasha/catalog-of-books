<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'description',
        'image',
        'author_id',
        'user_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
