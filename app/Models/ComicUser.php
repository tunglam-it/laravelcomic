<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicUser extends Model
{
    use HasFactory;
    protected $fillable = ['comic_id','user_id'];

}
