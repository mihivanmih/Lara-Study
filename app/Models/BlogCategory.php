<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
    const ROOT = 1;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description'
    ];

    /**
     *
     * Получаем родительскую категорию
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo( BlogCategory::class, 'parent_id', 'id');
    }

    /**
     *
     * Пример аксесуара (Accessor)
     * Вначале должен быть get в конце Attribute
     *
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Корень' : '???');
        return $title;
    }

    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }

}
