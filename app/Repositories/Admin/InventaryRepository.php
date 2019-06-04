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



    /**
     * Date: 02/06/2019
     *
     * @param $grids
     * @param $image
     * @param $product
     * @return mixed
     */
    public function createKit($configProduct, $grids, $image, $product, $photo)
    {
        if ($configProduct->grids == 1) {
            $dataForm['grid_id'] = $grids->id;
            $dataForm['admin_id'] = auth()->user()->id;
            $dataForm['profile_name'] = constLang('profile_name.admin');
            $dataForm['type_movement'] = constLang('type_movement.input');
            $dataForm['brand'] = $product->brand;
            $dataForm['section'] = $product->section;
            $dataForm['category'] = $product->category;
            $dataForm['product'] = $product->name;
            $dataForm['image'] = $photo;
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

        return false;
    }


    public function createUnit($configProduct, $grids, $image, $product, $photo)
    {
        if ($configProduct->grids == 1){
            dd("Em construção, o inventário");
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
    public function updateKit($configProduct, $grids, $image, $product, $photo)
    {

        if ($configProduct->grids == 1) {
            if($grids) {

                $dataForm['grid_id'] = $grids->id;
                $dataForm['admin_id'] = auth()->user()->id;
                $dataForm['profile_name'] = constLang('profile_name.admin');
                $dataForm['type_movement'] = constLang('type_movement.input');
                $dataForm['brand'] = $product->brand;
                $dataForm['section'] = $product->section;
                $dataForm['category'] = $product->category;
                $dataForm['product'] = $product->name;
                $dataForm['image'] = $photo;
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



    public function updateUnit($configProduct,$grids, $image, $product, $photo)
    {
        if ($configProduct->grids == 1){
            dd("Em construção, o inventário");
        }
    }


    public function deleteKit($product, $id)
    {
        dd("Em construção, o inventário");
    }

    public function deleteUnit($product, $id)
    {
        dd("Em construção, o inventário");
    }









}