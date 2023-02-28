<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','status','slug'];

    public function belongComic()
    {
        return $this->belongsToMany(Comic::class,'category_comics','category_id','comic_id')->withTimestamps();
    }
}
