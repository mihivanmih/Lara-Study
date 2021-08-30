<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogCategoryRepository extends CoreRepository
{
    protected  function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return mixed
     * Получить модель для редактирования в админке
     *
     */
    public function getEdit($id)
    {
        return $this->startCounditions()->find($id);
    }

    /**
     * @return mixed
     * Получить список категорий для вывода в выпадающем списке
     *
     */
    public function getForComboBox()
    {
        /*        $result[] = $this->startCounditions()->all();
        $result[] = $this
            ->startCounditions()
            ->select('blog_categories.*', \DB::raw('CONCAT (id, ". ", title) AS id_title'))
            ->toBase()
            ->get();*/

        $fields = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title'
        ]);

        $result = $this
            ->startCounditions()
            ->selectRaw($fields)
            ->toBase()
            ->get();


        return  $result;

    }

    public function getAllWithPaginate ($count = null)
    {
        $fields = ['id', 'title', 'parent_id'];

          $result = $this
            ->startCounditions()
            ->select($fields)
            ->with([
                  'parentCategory:id,title'
              ])
            ->paginate($count);

          return $result;
    }

}
