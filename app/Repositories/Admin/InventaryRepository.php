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
     * @param $grids
     * @param $image
     * @param $product
     * @return mixed
     */
    public function createKit($grids, $image, $product)
    {
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
        $dataForm['amount'] = $grids->input;
        $dataForm['kit'] = $product->kit;
        $dataForm['kit_name'] = $product->kit_name;
        $dataForm['units'] = $product->unit;
        $dataForm['offer'] = $product->offer;
        $dataForm['cost_unit'] = $product->cost->value;
        $dataForm['cost_total'] = $grids->input * $product->cost->value;
        $dataForm['stock'] = $grids->input;

        $data = $this->model->create($dataForm);
        //dd($data);
        if ($data) {
            return $data;
        }
    }

    public function createUnit($grids, $image, $product)
    {
        dd("Vamos fazer ainda");

    }




}