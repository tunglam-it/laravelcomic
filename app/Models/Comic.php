<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','description','image','status','author'];

    public function belongCategory()
    {
        return $this->belongsToMany(Category::class,'category_comics','comic_id','category_id')->withTimestamps();
    }

    public function hasChapter()
    {
        return $this->hasMany(Chapter::class);
    }

    public function likedByUser()
    {
        return $this->belongsToMany(User::class,'comic_users','comic_id','user_id');
    }



}
