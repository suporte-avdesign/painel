<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\Inventary as Model;
use AVDPainel\Interfaces\Admin\InventaryInterface;

use Illuminate\Foundation\Validation\ValidatesRequests;

class InventaryRepository implements InventaryInterface
{
    use ValidatesRequests;

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * ValidatesRequests
     *
     * @param  array $input
     * @param  array $messages
     * @return array
     */
    public function rules($input, $messages, $id='')
    {
        $this->validate($input, $this->model->rules($id), $messages);
    }

    /**
     * Init Model
     *
     * @return array
     */
    public function getAll()
    {
        $data  = $this->model->get();
        return $data;    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }


    public function getGrids($id)
    {
        return $this->model->where('grid_id', $id)->get();
    }



    /**
     * Date: 02/06/2019
     *
     * @param $configProduct
     * @param $grids
     * @param $image
     * @param $product
     * @return mixed
     */
    public function createKit($configProduct, $grids, $image, $product)
    {
        if ($configProduct->grids == 1) {
            $dataForm['product_id'] = $product->id;
            $dataForm['image_color_id'] = $image->id;
            $dataForm['grid_id'] = $grids->id;
            $dataForm['admin_id'] = auth()->user()->id;
            $dataForm['profile_name'] = constLang('profile_name.admin');
            $dataForm['type_movement'] = constLang('type_movement.input');
            $dataForm['brand'] = $product->brand;
            $dataForm['section'] = $product->section;
            $dataForm['category'] = $product->category;
            $dataForm['product'] = $product->name;
            $dataForm['image'] = $image->image;
            $dataForm['code'] = $image->code;
            $dataForm['color'] = $image->color;
            $dataForm['grid'] = $grids->grid;
            $dataForm['amount'] = (int) $grids->input;
            $dataForm['kit'] = $product->kit;
            $dataForm['kit_name'] = $product->kit_name;
            $dataForm['units'] = $product->unit;
            $dataForm['offer'] = $product->offer;
            $dataForm['cost_unit'] = $product->cost->value;
            $dataForm['cost_total'] = $grids->input * $product->cost->value;
            $dataForm['stock'] = (int) $grids->input;
        }

        $data = $this->model->create($dataForm);
        if ($data) {
            return $data;
        }

    }

    /**
     * Date: 06/04/2019
     *
     * @param $configProduct
     * @param $grids
     * @param $image
     * @param $product
     * @param $photo
     * @return mixed
     */
    public function updateKit($configProduct, $grids, $image, $product)
    {
        if ($configProduct->grids == 1) {
            if($grids) {

                $dataForm['product_id'] = $product->id;
                $dataForm['image_color_id'] = $image->id;
                $dataForm['grid_id'] = $grids->id;
                $dataForm['admin_id'] = auth()->user()->id;
                $dataForm['profile_name'] = constLang('profile_name.admin');
                $dataForm['type_movement'] = constLang('type_movement.input');
                $dataForm['brand'] = $product->brand;
                $dataForm['section'] = $product->section;
                $dataForm['category'] = $product->category;
                $dataForm['product'] = $product->name;
                $dataForm['image'] = $image->image;
                $dataForm['code'] = $image->code;
                $dataForm['color'] = $image->color;
                $dataForm['grid'] = $grids->grid;
                $dataForm['amount'] = (int) $grids->entry;
                $dataForm['kit'] = $product->kit;
                $dataForm['kit_name'] = $product->kit_name;
                $dataForm['units'] = $product->unit;
                $dataForm['offer'] = $product->offer;
                $dataForm['cost_unit'] = $product->cost->value;
                $dataForm['cost_total'] = $grids->entry * $product->cost->value;
                $dataForm['stock'] = (int) $grids->stock;

                $data = $this->model->create($dataForm);
                if ($data) {
                    return $data;
                }
            } else {
                return true;
            }
        }
    }

    /**
     * Date: 06/12/2019
     *
     * @param $product
     * @param $image
     * @param $grids
     * @return mixed
     */
    public function deleteKit($configProduct, $product, $image, $grids)
    {
        if ($configProduct->grids == 1) {
            $dataForm['product_id'] = $image->product_id;
            $dataForm['image_color_id'] = $image->id;
            $dataForm['grid_id'] = $grids->id;
            $dataForm['admin_id'] = auth()->user()->id;
            $dataForm['profile_name'] = constLang('profile_name.admin');
            $dataForm['type_movement'] = constLang('type_movement.delete');
            $dataForm['note'] = constLang('messages.products.delete_true') . ' ' . auth()->user()->name;
            $dataForm['brand'] = $product->brand;
            $dataForm['section'] = $product->section;
            $dataForm['category'] = $product->category;
            $dataForm['product'] = $product->name;
            $dataForm['image'] = $image->image;
            $dataForm['code'] = $image->code;
            $dataForm['color'] = $image->color;
            $dataForm['grid'] = $grids->grid;
            $dataForm['amount'] = $grids->stock;
            $dataForm['kit'] = $product->kit;
            $dataForm['kit_name'] = $product->kit_name;
            $dataForm['units'] = $product->unit;
            $dataForm['offer'] = $product->offer;
            $dataForm['cost_unit'] = $product->cost->value;
            $dataForm['cost_total'] = $grids->stock * $product->cost->value;
            $dataForm['stock'] = 0;

            $data = $this->model->create($dataForm);
            if ($data) {
                return $data;
            }
        }
    }


    /**
     * Date: 06/13/2019
     *
     * @param $configProduct
     * @param $grids
     * @param $image
     * @param $product
     * @return mixed
     */
    public function createUnit($configProduct, $grids, $image, $product)
    {
        if ($configProduct->grids == 1) {

            $dataForm['product_id'] = $product->id;
            $dataForm['image_color_id'] = $image->id;
            $dataForm['grid_id'] = $grids->id;
            $dataForm['admin_id'] = auth()->user()->id;
            $dataForm['profile_name'] = constLang('profile_name.admin');
            $dataForm['type_movement'] = constLang('type_movement.input');
            $dataForm['brand'] = $product->brand;
            $dataForm['section'] = $product->section;
            $dataForm['category'] = $product->category;
            $dataForm['product'] = $product->name;
            $dataForm['image'] = $image->image;
            $dataForm['code'] = $image->code;
            $dataForm['color'] = $image->color;
            $dataForm['grid'] = $grids->grid;
            $dataForm['amount'] = (int)$grids->input;
            $dataForm['kit'] = $product->kit;
            $dataForm['kit_name'] = $product->kit_name;
            $dataForm['units'] = $product->unit;
            $dataForm['offer'] = $product->offer;
            $dataForm['cost_unit'] = $product->cost->value;
            $dataForm['cost_total'] = $grids->input * $product->cost->value;
            $dataForm['stock'] = (int)$grids->input;

            $data = $this->model->create($dataForm);
            if ($data) {
                return $data;
            }
        }
    }


    /**
     * Date: 06/13/2019
     *
     * @param $configProduct
     * @param $grid
     * @param $image
     * @param $product
     * @param $action
     * @return mixed
     */
    public function updateUnit($configProduct, $grid, $image, $product, $action)
    {
        if ($action['name'] == 'update') {
            $moviments = $this->getGrids($grid->id);
            foreach ($moviments as $moviment){
                if ($moviment->grid != $grid->grid) {
                    $name = [
                        'grid' => $grid->grid
                    ];
                    $upMov = $moviment->update($name);
                }
            }
        }
        if ($configProduct->grids == 1) {

            if ($action['entry'] == 'create') {

                $dataForm['product_id'] = $product->id;
                $dataForm['image_color_id'] = $image->id;
                $dataForm['grid_id'] = $grid->id;
                $dataForm['admin_id'] = auth()->user()->id;
                $dataForm['profile_name'] = constLang('profile_name.admin');
                $dataForm['type_movement'] = constLang('type_movement.input');
                $dataForm['brand'] = $product->brand;
                $dataForm['section'] = $product->section;
                $dataForm['category'] = $product->category;
                $dataForm['product'] = $product->name;
                $dataForm['image'] = $image->image;
                $dataForm['code'] = $image->code;
                $dataForm['color'] = $image->color;
                $dataForm['grid'] = $grid->grid;
                $dataForm['amount'] = (int)$grid->input;
                $dataForm['kit'] = $product->kit;
                $dataForm['kit_name'] = $product->kit_name;
                $dataForm['units'] = $product->unit;
                $dataForm['offer'] = $product->offer;
                $dataForm['cost_unit'] = $product->cost->value;
                $dataForm['cost_total'] = $grid->input * $product->cost->value;
                $dataForm['stock'] = (int)$grid->stock;

                $data = $this->model->create($dataForm);
                if ($data) {
                    return $data;
                }
            }
        }
    }



    public function deleteUnit($configProduct, $product, $image, $grid)
    {
        if ($configProduct->grids == 1) {

            $dataForm['product_id'] = $image->product_id;
            $dataForm['image_color_id'] = $image->id;
            $dataForm['grid_id'] = $grid->id;
            $dataForm['admin_id'] = auth()->user()->id;
            $dataForm['profile_name'] = constLang('profile_name.admin');
            $dataForm['type_movement'] = constLang('type_movement.delete');
            $dataForm['note'] = constLang('messages.products.delete_true').' '. auth()->user()->name;
            $dataForm['brand'] = $product->brand;
            $dataForm['section'] = $product->section;
            $dataForm['category'] = $product->category;
            $dataForm['product'] = $product->name;
            $dataForm['image'] = $image->image;
            $dataForm['code'] = $image->code;
            $dataForm['color'] = $image->color;
            $dataForm['grid'] = $grid->grid;
            $dataForm['amount'] = $grid->stock;
            $dataForm['kit'] = $product->kit;
            $dataForm['kit_name'] = $product->kit_name;
            $dataForm['units'] = $product->unit;
            $dataForm['offer'] = $product->offer;
            $dataForm['cost_unit'] = $product->cost->value;
            $dataForm['cost_total'] = $grid->stock * $product->cost->value;
            $dataForm['stock'] = 0;

            $data = $this->model->create($dataForm);
            if ($data) {
                return $data;
            }
        }
    }











}