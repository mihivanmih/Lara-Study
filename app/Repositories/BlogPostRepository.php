<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogPostRepository extends CoreRepository
{
    protected  function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return mixed
     *
     * Получить список статей для вывода в списке
     * Админка
     */
    public function getAllWithPaginate ()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this
            ->startCounditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->with(['category' => function($query){
                $query->select('id', 'title');
            }])
            ->paginate(25);

        return $result;
    }

}
