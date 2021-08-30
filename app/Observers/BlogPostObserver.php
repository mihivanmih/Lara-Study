<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);

        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

     /**
        Обработка ПЕРЕД обновлением записи
     */
    public function updating(BlogPost $blogPost)
    {

/*        $test[] = $blogPost->isDirty(); //изменились ли какие то поля
        $test[] = $blogPost->isDirty('is_published'); //изменились ли конкретное поле
        $test[] = $blogPost->getAttribute('is_published');
        $test[] = $blogPost->is_published;
        $test[] = $blogPost->getOriginal('is_published'); //старое значение из базы
        dd($test);*/
        //return false; // вызов ошибки сохранения


       $this->setPublishedAt($blogPost);
       $this->setSlug($blogPost);

    }

    /**
     * Если дата публикации не установлена и происходит установка флага - Опубликовать
     * то устанавливаем дату публикации на текущую.
     *
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        if(empty($item->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }


    /**
     *  Если полу слаг пустое, то заполняем его конвертацией заголовка.
     *
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Установка значения полю content_html относительно поля content_raw
     *
     * @param BlogPost $blogPost
     */
    protected function setHtml(BlogPost $blogPost)
    {
        if($blogPost->isDirty('content_raw'))
        {
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     *
     * Если не указан user_id, то устанавливаем пользователя по-умолчанию
     *
     * @param BlogPost $blogPost
     */
    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
