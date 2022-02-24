<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title', 'excerpt', 'body'
    // ];
    protected $guarded = ['id'];
    protected $with = ['category', 'user']; //untuk eager load data, tiap pemanggilan model post akan membawa 2 tabel tersebut

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function getRouteKeyName()
{
    return 'slug';
}
}
