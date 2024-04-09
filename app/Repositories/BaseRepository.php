<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract public function getModel();

    public function getAll()
    {
        return $this->model->all();
    }

    public function getOne($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $model = $this->model->find($id);

        if ($model) {
            $model->update($attributes);
            return $model;
        }

        return null;
    }


    public function delete($id)
    {
        if ($this->model->find($id)) {
            return $this->model->where('id', '=', $id)->delete();
        }
        return false;
    }
}
