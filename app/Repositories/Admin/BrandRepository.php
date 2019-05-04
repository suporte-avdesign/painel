<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\Brand as Model;
use AVDPainel\Interfaces\Admin\BrandInterface;
use AVDPainel\Interfaces\Admin\ConfigKeywordInterface as Keywords;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BrandRepository implements BrandInterface
{
    use ValidatesRequests;

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model, Keywords $keywords)
    {
        $this->model    = $model;
        $this->keywords = $keywords;
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
    public function get()
    {
        $data  = $this->model->get();
        return $data;    
    }

    /**
     * Lista só com o name e o id.
     *
     * @return array
     */
    public function pluck()
    {
        return $this->model->orderBy('name')->where('status', 'Ativo')->pluck('name','id');
    }


    /**
     * Table: Keyword
     *
     * @return array
     */
    public function getAll($request)
    {
        $columns = array( 
            0  => 'order',
            1  => 'name',
            2  => 'visits',
            3  => 'description',
            4  => 'status',
            5  => 'contact',
            6  => 'email',
            7  => 'phone',
            8  => 'address',
            9 => 'number',
            10 => 'district',
            11 => 'city',
            12 => 'state',
            13 => 'zip_code',
            14 => 'tags',
            15 => 'status_logo',
            16 => 'status_banner',
            17 => 'id'
        );
  
        $totalData = $this->model->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
            
        if (empty($request->input('search.value'))) {            
            $query = $this->model->offset($start) ->limit($limit) ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $query =  $this->model->where('name','LIKE',"%{$search}%")
                            ->where('description','LIKE',"%{$search}%")
                            ->where('contact','LIKE',"%{$search}%")
                            ->where('email','LIKE',"%{$search}%")
                            ->where('city','LIKE',"%{$search}%")
                            ->orWhere('state', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $this->model->where('name','LIKE',"%{$search}%")
                            ->where('description','LIKE',"%{$search}%")
                            ->where('contact','LIKE',"%{$search}%")
                            ->where('email','LIKE',"%{$search}%")
                            ->where('city','LIKE',"%{$search}%")
                            ->orWhere('state', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data  = array();
        if(!empty($query))
        {
            foreach ($query as $val){

                ($val->status == 'Ativo' ? $color = 'blue' : $color = 'red');
                ($val->status_logo == 'Ativo' ? $color_logo = 'blue' : $color_logo = 'red');
                ($val->status_banner == 'Ativo' ? $color_banner = 'blue' : $color_banner = 'red');

                $edit   = "abreModal('Editar {$val->name}', '".route('marcas.edit', $val->id)."', 'brands', 2, 'true', 450, 450)";
                $delete = "deleteBrand('".route('marcas.destroy', ['id' => $val->id])."', '{$val->name}')";

                $nData['order']          = $val->order;
                $nData['name']           = $val->name;
                $nData['visits']         = $val->visits;
                $nData['description']    = $val->description;
                $nData['status']         = '<small class="tag '.$color.'-bg">'.$val->status.'</small>';
                $nData['contact']        = $val->contact;
                $nData['email']          = $val->email;
                $nData['phone']          = $val->phone;
                $nData['address']        = $val->address;
                $nData['number']         = $val->number;
                $nData['district']       = $val->district;
                $nData['city']           = $val->city;
                $nData['state']          = $val->state;
                $nData['zip_code']       = $val->zip_code;
                $nData['tags']           = $val->tags;
                $nData['status_logo']    = '<small class="tag '.$color_logo.'-bg">'.$val->status_logo.'</small>';
                $nData['status_banner']  = '<small class="tag '.$color_banner.'-bg">'.$val->status_banner.'</small>';
                $nData['id']             = $val->id;
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
    public function create($input)
    {
        $keywords = $this->keywords->rand();

        // if < 10 add 0 in front
        $count = strlen($input['order']);
        if ($count == 1) {
            $input['order'] = '0'.$input['order'];
        }

        if ($input['tags'] == '') {
            $input['tags']  = $keywords['genders'].','.$input['name'];
        }
        if ($input['description'] == '') {
            $input['description']  = $keywords['description'].' '.$input['name'];
        }
        $input['slug']   = str_slug($input['name'], "-");
        $input['visits'] = 0;

        $data = $this->model->create($input);
        if ($data) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Adicionou a Marca:'.$data->name.
                ', Descrição: '.$data->description.
                ', Tags: '.$data->tags)
            );

            return $data;
        }

        return false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  array $input
     * @return boolean true or false
     */
    public function update($input, $id)
    {
        // if < 10 add 0 in front
        $count = strlen($input['order']);
        if ($count == 1) {
            $input['order'] = '0'.$input['order'];
        }

        $data        = $this->model->find($id);
        $name        = $data->name;
        $tags        = $data->tags;
        $description = $data->description;

        $update = $data->update($input);
        if ($update) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Alterou a Marca:'.$name.
                ', Descrição:'.$data->description.
                ', Tags:'.$tags)
            );

            return true;
        }

        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $config
     * @param  int  $configImages
     * @return array
     */
    public function delete($id, $config, $configImages)
    {
       
        $total_products = 0;
        $colors         = 0;
        $data           = $this->model->find($id);
        $images         = $data->images;
        $products       = $data->products;

        if (count($products) >= 1) {
            $p=1;
            foreach ($products as $product) {
                $i = 1;
                $total_products += $p;                   
                foreach ($product->images as $color) {
                    $colors += $i;
                    foreach ($color->positions as $position) {
                        foreach ($configImages as $value) {
                            if ($value->type == 'P') {
                                $image_position = $value->path.$position->image;
                                if (file_exists($image_position)) {
                                    $remove = unlink($image_position);
                                }
                            }
                            if ($value->type == 'C') {
                                $image_color = $value->path.$color->image;
                                if (file_exists($image_color)) {
                                    $remove = unlink($image_color);
                                }
                            }
                        }
                    }
                }                        
            }
        }

        if (count($images) >= 1) {
            $path_logo   = $config->path.$config->width_logo.'x'.$config->height_logo.'/';
            $path_banner = $config->path.$config->width_banner.'x'.$config->height_banner.'/';
            foreach ($images as $name) {

                if (file_exists($path_logo.$name->image)) {
                    unlink($path_logo.$name->image);
                }

                if (file_exists($path_banner.$name->image)) {
                    unlink($path_banner.$name->image);
                }
            }
        }

        $delete = $data->delete();
        if ($delete) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Excluiu a Marca:'.$data->name.
                ', Descrição:'.$data->description.
                ', Tags:'.$data->tags)
            );
            
            $data['total_colors']   = $colors;
            $data['total_products'] = $total_products;

            return $data;
        }

        return false;
    }

}