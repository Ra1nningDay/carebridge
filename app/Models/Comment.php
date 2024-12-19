<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่สามารถทำการเพิ่มข้อมูลได้
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'post_id',  
        'parent_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // ความสัมพันธ์กับคอมเมนต์ย่อย (Children Comments)
    public function children(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // ความสัมพันธ์กับคอมเมนต์หลัก (Parent Comment)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
