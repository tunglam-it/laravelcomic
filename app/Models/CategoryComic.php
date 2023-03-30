<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryComic extends Model
{
    use HasFactory;
    protected $fillable = ['comic_id','category_id'];
}
