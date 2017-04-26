<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DB;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
    * function getCategoryLibrary.
     *
     * @return imageName
     */
    public function getCategoryLibrary($type_category, $array = ['*'])
    {
        return $this->model->where('type_category', config('setting.mutil-level.one'))->pluck('name', 'id')->all();
    }

    /**
    * function getSubCategory.
     *
     * @param $parent_id
     * @return imageName
     */
    public function getSubCategory($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->pluck('name', 'id')->all();
    }

    /**
    * function get memnu.
     *
     * @param $parent_id
     * @return imageName
     */
    public function getMenu()
    {
        return $this->model->with('subCategory')->where('type_category', config('setting.mutil-level.one'))->get();
    }

    /**
    * function getProductHome.
     *
     * @return true or false
     */
    public function getProductHome()
    {
        return $this->model->with('subCategory.products')->get();
    }

    /**
    * function productCategory.
     *
     * @return true or false
     */
    public function productCategory()
    {
        return $this->model->with('products')->where('type_category', config('setting.mutil-level.one'))->paginate(config('setting.user.paginate'));
    }

    /**
    * function createName.
     *
     * @return true or false
     */
    public function createName($input)
    {
        DB::beginTransaction();
        try {
            $parentCategory = [
                'name' => $input['category_name'],
                'image' => config('setting.images.category'),
                'type_category' => config('setting.mutil-level.one'),
                'parent_id' => config('setting.mutil-level.one'),
            ];

            $parentCategory = parent::create($parentCategory);

            $subCategory = [
                'name' => empty($input['sub_category_name']) ? $input['sub_category_name'] : 'default',
                'parent_id' => $parentCategory->id,
                'image' => config('setting.images.category'),
                'type_category' => config('setting.mutil-level.two'),
            ];

            $result = parent::create($subCategory);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function getCategoryId.
     *
     * @return true or false
     */
    public function getCategoryId($parentCategory, $subCategory)
    {
        try {
            $checkExitsParentCategory = $this->model->where('name', $parentCategory)->first();

            if (!is_null($checkExitsParentCategory)) {
                $checkExitsSubCategory = $this->model->where('name', $subCategory)->first();

                if (!is_null($checkExitsSubCategory)) {
                    return $checkExitsSubCategory->id;
                } else {
                    $input = $this->dataCategory($subCategory, $checkExitsParentCategory->id, config('setting.mutil-level.two'));
                    $subCategory = $this->model->create($input);

                    return $subCategory->id;
                }
            }

            //insert
            $parentCategory = $this->model->create($this->dataCategory($parentCategory, -1, config('setting.mutil-level.one')));
            $subCategory = $this->model->create($this->dataCategory($subCategory, $parentCategory->id, config('setting.mutil-level.two')));

            return $subCategory->id;
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }

    /**
     *data category.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function dataCategory($name, $parentCategory, $typeCategory)
    {
        $data = [];
        $data['name'] = $name;
        $data['image'] = config('setting.images.category');
        $data['parent_id']= $parentCategory;
        $data['type_category']= $typeCategory;
        return $data;
    }
}
