<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    
     protected $fillable = [
        'isbn',
        'title',
        'subtitle',   
        'author',
        'published',
        'publisher',
        'pages',
        'description',
        'website',
    ];
}
