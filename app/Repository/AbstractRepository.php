<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected static $model;

    public static function loadModel(): Model
    {
        // TODO: inicialiaza a minha model
        return app(static::$model);
    }

    public static function all(): Collection
    {
        return  self::loadModel()::all();
    }

    public static function find(int $id): Model|null
    {
        return self::loadModel()::query()->find($id);
    }

    public static function create(array $attributes = []): Model|null
    {
        return self::loadModel()::query()->create($attributes);
    }

    public static function delete(int $id): int
    {
        return self::loadModel()::query()->where(['id' => $id])->delete();
    }

    public static function update(int $id, array $attributes): int
    {
        return self::loadModel()::query()->where(['id' => $id])->update($attributes);
    }
}
