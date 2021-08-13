<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CoreRepository
 * @package App\Repositories
 *
 * Репозиторий работы с сущностью.
 * Может выдавать наборы данных.
 * Не может создавать/изменять сущности.
 *
 */
abstract class CoreRepository
{
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function startCounditions() {
        return clone $this->model;
    }
}
