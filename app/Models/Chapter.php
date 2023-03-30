<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['title','comic_id','description','chapter_content','status','slug_chapter'];

    public function belongComic()
    {
        return $this->belongsTo(Comic::class,'comic_id');
    }
}
