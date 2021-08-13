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
        return $this->startCounditions()->all();
    }
}
