<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่สามารถทำการเพิ่มข้อมูลได้
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'author_id', 'image'];

    /**
     * สร้างความสัมพันธ์กับ Model User (ผู้เขียน)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * ความสัมพันธ์กับ Comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
