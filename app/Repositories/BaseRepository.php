<?php
/**
* Base Repository
*/
namespace App\Repositories;

use Exception;
use DB;
use Auth;
use DateTime;
use Carbon\Carbon;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function pluck($column)
    {
        return $this->model->pluck($column);
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = $limit ?: config('settings.admin.paginate');

        return $this->model->paginate($limit, $columns);
    }

    public function find($id, $columns = ['*'])
    {
        return $data = $this->model->find($id);
    }

    public function where($conditions, $operator = null, $value = null)
    {
        return $this->model->where($conditions, $operator, $value)->get();
    }

    public function orWhere($conditions, $operator = null, $value = null)
    {
        return $this->model->orWhere($conditions, $operator, $value);
    }

    public function whereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];

        return $this->model->whereIn($column, $values);
    }

    public function create($inputs)
    {
        return $this->model->create($inputs);
    }

    public function update($inputs, $id)
    {
        return $this->model->find($id)->update($inputs);
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function delete($ids)
    {
        return $this->model->destroy($ids);
    }

    public function search($column, $value)
    {
        return $this->model->where('$column LIKE $value');
    }

    public function uploadImages($image = null, $fileImages = null, $namedefault = null)
    {
        if ($image != $namedefault) {
            unlink(config('setting.path.file') . $image);
        }

        $dt = new DateTime();
        $arr_images = explode('.', $fileImages->getClientOriginalName());
        $imageName = 'product_' . $dt->format('Y-m-d-H-i-s') . '.' .  $arr_images[count($arr_images) - 1];
        $fileImages->move(config('setting.path.file'), $imageName);

        return $imageName;
    }

    public function importFile($file = null)
    {
        $dt = new DateTime();
        $files = explode('.', $file->getClientOriginalName());
        $image = 'product_' . $dt->format('Y-m-d-H-i-s') . '.' .  $files[count($files) - 1];
        $file->move(config('setting.path.file'), $image);

        return $image;
    }
}
