<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'comment',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
