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
     * Store a newly created resource in storage.
     *
     * @param  array $input
     * @return boolean true or false
     */
    public function create($grids, $image, $product, $kit)
    {
        if ($kit == 1) {
            $input['admin_id'] = auth()->user()->id;
            $input['profile_name'] = constLang('profile_name.admin');
            $input['type_movement'] = constLang('type_movement.input');
            $input['brand'] = $product->brand;
            $input['section'] = $product->section;
            $input['category'] = $product->category;
            $input['product'] = $product->name;
            $input['image'] = $image->image;
            $input['code'] = $image->code;
            $input['color'] = $image->color;
            $input['grid'] = $grids['grid'];
            $input['amount'] = $grids['input'];
            $input['kit'] = $kit;
            $input['kit_name'] = $product->kit_name;
            $input['units'] = $product->unit;
            $input['offer'] = $product->offer;
            $input['cost_unit'] = $product->cost->value;
            $input['cost_total'] = $grids['input'] * $product->cost->value;
            $input['stock'] = $grids['input'];

            $data = $this->model->create($input);
            if ($data) {
                return $data;
            }
        }
    }



}