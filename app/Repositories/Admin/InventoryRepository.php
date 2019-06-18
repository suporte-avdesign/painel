<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\Inventory as Model;
use AVDPainel\Interfaces\Admin\InventoryInterface;
use AVDPainel\Interfaces\Admin\ConfigColorPositionInterface as ConfigImage;



class InventoryRepository implements InventoryInterface
{

    private $disk;
    private $view;
    public $model;
    private $photoUrl;



    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model, ConfigImage $configImage)
    {
        $this->model = $model;
        $this->configImage = $configImage;
        $this->view = 'backend.reports.inventory';

        $this->photoUrl = 'storage/';
        $this->disk = storage_path('app/public/');

    }


    /**
     * Date: 15/06/2019
     *
     * @param $request
     * @return json
     */
    public function getAll($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'code',
            2 => 'kit_name',
            3 => 'amount',
            4 => 'stock',
            5 => 'updated_at'
        );

        $totalData = $this->model->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $query = $this->model->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        } else {
            $search = $request->input('search.value');

            $query =  $this->model->where('code','LIKE',"%{$search}%")
                ->orWhere('image', 'LIKE',"%{$search}%")
                ->orWhere('grid', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = $this->model->where('code','LIKE',"%{$search}%")
                ->orWhere('image', 'LIKE',"%{$search}%")
                ->orWhere('grid', 'LIKE',"%{$search}%")
                ->count();
        }

        // Configurações
        $configImage   = $this->configImage->setName('default', 'T');

        $path    = $configImage->path;
        $data    = array();

        if(!empty($query))
        {
            foreach ($query as $val){

                if ($val->image != '') {
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'" src="'.url($this->photoUrl.$path.$val->image).'" width="80" /></a>';
                } else {
                    $image = '<img src="'.url('backend/img/default/no_image.png').'" />';
                }

                $info_product = view("{$this->view}.info_product_render", compact('val'))->render();


                $nData['image']   = $image;
                $nData['code']    = $info_product;
                $nData['kit_name']= $val->kit_name;
                $nData['amount']  = $val->amount;
                $nData['stock']   = $val->stock;
                $nData['updated_at'] = date('d/m/Y H:i:s', strtotime($val->updated_at));;

                $data[] = $nData;
            }

        }

        $out = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return $out;

    }

    /**
     * Date: 06/15/2019
     *
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }


    /**
     * Date: 06/15/2019
     *
     * @param $id
     * @return mixed
     */
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
            $dataForm['kit_name'] = $product->kit_name. '('.$product->unit.' '.$product->measure.')';
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
                $dataForm['kit_name'] = $product->kit_name. '('.$product->unit.' '.$product->measure.')';
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
    public function deleteKit($configProduct, $product, $image, $grid)
    {
        if ($configProduct->grids == 1) {
            $dataForm['product_id'] = $image->product_id;
            $dataForm['image_color_id'] = $image->id;
            $dataForm['grid_id'] = $grid->id;
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
            $dataForm['grid'] = $grid->grid;
            $dataForm['amount'] = $grid->stock;
            $dataForm['kit'] = $product->kit;
            $dataForm['kit_name'] = $product->kit_name. '('.$product->unit.' '.$product->measure.')';
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
            $dataForm['kit_name'] = $product->unit. ' '.$product->measure;
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
                $dataForm['kit_name'] = $product->unit. ' '.$product->measure;
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
            $dataForm['kit_name'] = $product->unit. ' '.$product->measure;
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