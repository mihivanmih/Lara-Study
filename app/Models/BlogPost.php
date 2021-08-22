<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes; //не выбирает из базы `deleted_at` is null
    //use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Категория статьи
     */
    public function category()
    {
        //Статья принадлежит категории
        return $this->belongsTo( BlogCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Автор статьи
     */
    public function user()
    {
        // Статья принадлежит пользоватю
        return $this->belongsTo( User::class);
    }

}
