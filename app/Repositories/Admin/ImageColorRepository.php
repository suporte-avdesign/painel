<?php

namespace AVDPainel\Repositories\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use AVDPainel\Models\Admin\ImageColor as Model;
use AVDPainel\Interfaces\Admin\ImageColorInterface;
use AVDPainel\Interfaces\Admin\ConfigKeywordInterface as Keywords;
use AVDPainel\Interfaces\Admin\ConfigColorPositionInterface as ConfigImage;

class ImageColorRepository implements ImageColorInterface
{

    public $model;
    public $keywords;
    private $photoUrl;
    private $disk;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(
        Model $model, 
        Keywords $keywords,
        ConfigImage $configImage)
    {
        $this->model          = $model;
        $this->keywords       = $keywords;
        $this->configImage    = $configImage;

        $this->photoUrl      = 'storage/';
        $this->disk          = storage_path('app/public/');
    }

    /**
     * Init Model
     *
     * @return array
     */
    public function getAll($request)
    {
        $columns = array( 
            0 => 'id',
            1 => 'code',
            2 => 'color',
            3 => 'category',
            4 => 'section',
            5 => 'brand',
            6 => 'visits',
            7 => 'active',
            8 => 'actions'
        );
  
        $totalData = $this->model->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
            
        if (empty($request->input('search.value'))) {

            $query = $this->model    
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        } else {
            $search = $request->input('search.value'); 

            $query =  $this->model->where('slug','LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $this->model->where('slug','LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
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
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'" src="'.url($this->j.$path.$val->image).'" width="80" /></a>';
                } else {
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'"  src="'.url('assets/imagens/padrao/product-no-image.png').'" /></a>'; 
                }

                ($val->cover == 1 ? $cover   = '<p><small class="tag">Capa</small></p>' : $cover = '');

                // Active
                ($val->active == 1 ? $color_status = 'icon-tick green-gradient compact">Ativo' : $color_status = 'grey-gradient compact">Inativo');
                $clickStatus = "statusColors('{$val->id}','".route('colors-status', ['idpro' => $val->product_id,'id' => $val->id])."','{$val->active}','{$val->cover}','".csrf_token()."')";
                $status  = '<span id="status-'.$val->id.'"><button type="button" onclick="'.$clickStatus.'" class="button '.$color_status.'</button></span>';
                $color   = $cover.'<span id="color-'.$val->id.'">'.$val->color.'</span>';
                $code    = '<span id="code-'.$val->id.'">'.$val->code.'</span>';

                $edit   = "abreModal('Editar: Cor {$val->color}', '".route('colors-product.edit', ['idpro' => $val->product_id,'id' => $val->id])."', 'form-colors', 2, 'true',800,780)";
                $delete = "deleteColor('{$val->id}', '".route('colors-product.destroy', ['idpro' => $val->product_id, 'id' => $val->id])."')";

                $nData['image']    = $image;
                $nData['code']     = $code;
                $nData['color']    = $color;
                $nData['category'] = $val->category;
                $nData['section']  = $val->section;
                $nData['brand']    = $val->brand;
                $nData['visits']   = $val->visits;
                $nData['active']   = $status;
                $nData['actions']  = '<span class="button-group">';
                if (Gate::allows('product-images-delete')) {
                    $nData['actions'] .= '<button onclick="'.$delete.'" class="button icon-trash red-gradient compact"></button>';
                }
                if (Gate::allows('product-images-update')) {
                    $nData['actions'] .= '<button onclick="'.$edit.'" class="button icon-pencil compact">Editar</button>';
                }
                $nData['actions']  .= '</span>';
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
     * @param $request
     * @param $mod_id
     * @return array
     */
    public function search($request, $mod_id, $route)
    {

        $data = array();
        $totalData=0;
        $totalFiltered=0;

        $search = $request->input('search.value');

        if(!empty($search) && strlen($search) >= 3) {

            $columns = array(
                0 => 'image',
                1 => 'code',
                2 => 'color',
                3 => 'category',
                4 => 'section',
                5 => 'brand',
                6 => 'id'
            );

            $limit = 10;
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir   = $request->input('order.0.dir');


            $query =  $this->model->where('slug','LIKE',"%{$search}%")->with(array(
                'sizes' => function ($query) use($search) {
                    $query->orderBy('grid');
                }
            ))
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();


            $totalFiltered = $this->model->where('slug','LIKE',"%{$search}%")->with(array(
                'sizes' => function ($query) use($search) {
                    $query->orderBy('grid');
                }
            ))->count();


            $totalData = $totalFiltered;

            // Configurações
            $configImage   = $this->configImage->setName('default', 'T');

            $path    = $configImage->path;
        }


        if(!empty($query))
        {
            foreach ($query as $val){

                $grids='';
                $kits='';
                $i=0;

                if ($val->kit == 1) {
                    $unit     = $val->product->unit;
                    $measure  = $val->product->measure;
                    $kit_name = $val->product->kit_name;
                    $kits = '<label for="kit-'.$val->id.'" class="button silver-gradient">'.$kit_name.' '.$unit.' '.$measure.'</label>';
                }

                foreach ($val->sizes as $size) {
                    $grids .= '<p class="button-height">';
                        $grids .= '<span class="input">';
                            $grids .= $kits.'<label for="size-'.$size->grid.'" class="button blue-gradient">'.$size->grid.'</label>';
                            $grids .= '<input type="text" id="qty-'.$size->grid.'" name="grid['.$size->id.']" class="input-unstyled" placeholder="Qtd" value="" autocomplete="off" style="width: 30px;">';
                        $grids .= '</span>';
                    $grids .= '</p>';
                    $i++;
                }

                if ($val->image != '') {
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'" src="'.url($this->j.$path.$val->image).'" width="80" /></a>';
                } else {
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'"  src="'.url('assets/imagens/padrao/product-no-image.png').'" /></a>';
                }

                ($val->active == 1 ? $status   = '<p><small class="tag">Ativo</small></p>' : $status = '<p><small class="tag red-bg">Inativo</small></p>');

                $nData['image']    = $image;
                $nData['code']     = $val->code.'<p>'.$val->category.' <br>'.$val->section.'</p>';
                $nData['color']    = $status. $val->color;
                $nData['category'] = $val->category;
                $nData['section']  = $val->section;
                $nData['brand']    = $val->brand;
                $nData['id']       = $val->id;
                $nData['grids']    = $grids;
                $nData['token']    = csrf_token();
                $nData['action']   = route($route, ["id" => $val->id, "mod_id" => $mod_id]);

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
     * Date 06/02/2019
     *
     * @return array
     */
    public function get($id)
    {
        $data  = $this->model->where('product_id', $id)->get();
        return $data;    
    }


    /**
     * Date 06/02/2019
     *
     * @param  int  $id
     * @return array
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }

    /**
     * Date 06/02/2019
     * Falta definir $input['html'] hexa,crop,thumb
     *
     * @param $input
     * @param $config
     * @return mixed
     */
    public function create($input, $product, $config)
    {
        $count = strlen($input['order']);
        if ($count == 1) {
            $dataForm['order'] = '0'.$input['order'];
        }

        $dataForm['html']        = $input['html'];
        $dataForm['code']        = $input['code'];
        $dataForm['color']       = $input['color'];
        $dataForm['active']      = $input['active'];
        $dataForm['cover']       = $input['cover'];
        $dataForm['product_id']  = $input['product_id'];
        $dataForm['description'] = $input['description'];

         /* facknews*/
        $dataForm['slug']        = numLetter(time());
        $dataForm['image']       = url('backend/img/default/no_image.png');

        if ($dataForm['cover'] == 1 && $dataForm['active'] == constLang('active_true')) {
            $cover = $this->changeCover($product, false, 'create');
        }
        $data = $this->model->create($dataForm);
        //dd($data);
        if ($data) {
            ($data->cover == 1 ? $cover = constLang('active_true') : $cover = constLang('active_false'));
            generateAccessesTxt(utf8_decode('- Upload Foto:'.
                ' '.constLang('code').':'.$data->code.
                ', '.constLang('color').':'.$data->color.
                ', '.constLang('status').':'.$data->active.
                ', '.constLang('cover').':'.$data->cover)
            );
            return $data;
        }
    }

    /**
     * 06/02/2019
     *
     * @param $input
     * @param $config
     * @param $image
     * @return bool
     */
    public function update($input, $config, $product, $image)
    {
        $access   = constLang('updated').' '.constLang('product');
        $dataForm = [];
        $count = strlen($input['order']);
        if ($count == 1) {
           $input['order'] = '0' .$input['order'];
        }
        if ($image->code != $input['code']) {
            $dataForm['code'] = $input['code'];
            $access .= ' '.constLang('code').':'.$image->code.'/'.$input['code'];
        }
        if ($image->color != $input['color']) {
            $dataForm['color'] = $input['color'];
            $access .= ' '.constLang('color').':'.$image->color.'/'.$input['color'];
        }
        if ($image->description != $input['description']) {
            $dataForm['description'] = $input['description'];
            $access .= ' '.constLang('description').':'.$image->description.'/'.$input['description'];
        }
        if ($image->active != $input['active']) {
            $dataForm['active'] = $input['active'];
            $access .= ' '.constLang('status').':'.$image->active.'/'.$input['active'];
        }

        if ($image->order != $input['order']) {
            $dataForm['order'] = $input['order'];
            $access .= ' '.constLang('order').':'.$image->order.'/'.$input['order'];
        }

        if ($image->cover != $input['cover'] && $input['active'] == constLang('active_true')) {
            $dataForm['cover'] = $input['cover'];
            $access .= ' '.constLang('cover').':'.$image->cover.'/'.$input['cover'];
        }
        if ($input['cover'] == 1 && $input['active'] == constLang('active_true')){
            foreach ($product->images as $img) {
                $id = $img->id;
                if ($img->cover == 1) {
                    $up = $this->model->find($id)->update(['cover' => 0]);
                }
            }
        }

        if(!empty($dataForm)){
            $update = $image->update($dataForm);
            generateAccessesTxt(
                date('H:i:s').utf8_decode(' '.$access)
            );
            // important get active_cover
            $cover = $this->changeCover($product, $image, 'update_'.$input['active'].'_'.$input['cover']);

            return $update;
        }
        return true;

    }


    /**
     * Date: 06/04/2019
     *
     * @param $image
     * @param $product
     * @param $config
     * @return bool
     */
    public function delete($image, $product, $config, $reload)
    {
        $cover = null;
        $positions = $image->positions;

        foreach ($config as $value) {
            if (!empty($positions)) {
                if ($value->type == 'P') {
                    foreach ($positions as $position) {
                        $pos = $this->disk.$value->path.$position->image;
                        if (file_exists($pos)) {
                            $remove = unlink($pos);
                        }
                    }
                }
            }

            if ($value->type == 'C') {
                if ($value->default != 'T') {
                    $color = $this->disk.$value->path.$image->image;
                    if (file_exists($color)) {
                        $remove = unlink($color);
                    }
                }
            }
        }

        $delete = $image->delete();
        if ($delete) {
            if ($image->cover == 1) {
                $cover = $this->changeCover($product, $image, 'delete');
            }
            ($image->cover == 1 ? $txtCover = constLang('yes') : $txtCover = constLang('not'));
            generateAccessesTxt(date('H:i:s') . utf8_decode(
                    ' ' . constLang('messages.products.delete_true') .
                    ':' . $product->name .
                    ', ' . constLang('code') . ':' . $image->code .
                    ', ' . constLang('color') . ':' . $image->color .
                    ', ' . constLang('status') . ':' . $image->active .
                    ', ' . constLang('cover') . ':' . $txtCover)
            );

            $success = true;
            $message = constLang('messages.products.delete_true');

        } else {
            $success = false;
            $message = constLang('messages.products.delete_false');
        }

        $out = array(
            'success' => $success,
            'message' => $message,
            'alert' => $cover,
            'reload'  => $reload
        );

        return $out;

    }

    /**
     * Date: 06/03/2019
     *
     * @param $config
     * @param $input
     * @param $image
     * @param $product
     * @param $file
     * @return bool|string
     */
    public function uploadImages($config, $input, $image, $product, $file)
    {
        if ($input['ac'] == 'update') {
            foreach ($config as $value) {
                $photo = $this->disk . $value->path . $image->image;
                if (file_exists($photo)) {
                    $delete = unlink($photo);
                }
            }
        }

        $words = $this->keywords->rand();
        $ext  = $file->getClientOriginalExtension();
        $color = preg_replace("/[^A-Za-z]/", "-", $image->color);
        $name = Str::slug($words['description'].
                '-'.$product->name.
                '-'.$product->category.
                '-'.$product->section.
                '-'.$color.
                '-'.$product->brand.
                '-'.config('app.name').
                '-'.numLetter(date('Ymdhs'),'letter')).'.'.$ext;

        foreach ($config as $value) {
            if ($value->type == 'C') {
                $width    = $value->width;
                $height   = $value->height;
                $path     = $this->disk . $value->path;
                $upload = Image::make($file)->resize($width, $height)->save($path.$name);
            }
        }
        if ($upload) {
            $dataForm['image'] = $name;
            $dataForm['slug'] = Str::slug($product->name.
                '-'.$product->category.
                '-'.$product->section.
                '-'.$color.
                '-'.$product->brand.
                '-'.numLetter($image->id, 'letter').
                '-'.$image->code);
        }
        $update = $image->update($dataForm);
        if($update) {
            return $dataForm['image'];
        }

        return false;
    }


    /**
     * Date: 06/03/2019
     *
     * @param $config
     * @param $image
     * @return array
     */
    public function uploadRender($config, $image, $action)
    {
        foreach ($config as $value) {
            if ($value->default == 'T') {
                $path = $this->photoUrl.$value->path;
            }
        }

        if ($action == 'create') {
            $out = array(
                "ac"         => $action,
                "success"    => true,
                "message"    => constLang('upload_true.image'),
                "id"         => $image->id,
                "name"       => $image->slug,
                "color"      => $image->color,
                "code"       => $image->code
            );
        } else {
            $render = view('backend.colors.gallery-render', compact('action','image', 'path'))->render();
            $out = array(
                "success"    => true,
                "message"    => constLang('upload_true.image'),
                "ac"         => $action,
                "html"       => $render,
                "id"         => $image->id,
                "product_id" => $image->product_id
            );
        }
        return $out;
    }

    /**
     * Date: 06/06/2019
     *
     * @param $input
     * @param $product
     * @param $view
     * @param $id
     * @return array
     */
    public function status($input, $product, $view, $id)
    {
        $html  = null;
        $cover = null;
        $image = $this->model->find($id);

        ($input['active'] == constLang('active_true') ?
            $dataForm['active'] = constLang('active_false') :
            $dataForm['active'] = constLang('active_true'));

        if ($image->cover == 1 && $dataForm['active'] == constLang('active_false')){
            $update = $image->update($dataForm);
            if ($update) {
                $cover  = $this->changeCover($product, $image, 'status');
            }
        } else {
            $update = $image->update($dataForm);
        }
        if ($update) {
            $success = true;
            $message = constLang('status_true').' '.$image->active;
            generateAccessesTxt(date('H:i:s').utf8_decode(
                ' '.constLang('updated').
                ' '.constLang('status').
                ' '.constLang('product').
                ':'.$product->name.
                ', '.constLang('code').':'.$image->code.
                ' - '.$image->active)
            );

            $html = view("{$view}.status-render", compact('image'))->render();
        } else {
            $success = false;
            $message = constLang('status_false');
        }

        $out = array(
            "success" => $success,
            "message" => $message,
            'alert' => $cover,
            "html"  => $html
        );

        return $out;
    }

    /**
     * Date: 06/05/2019
     * Create cover=1 - active=true
     * Status cover=1 - active=true
     * Delete cover=1 - active=true
     * Update cover=1 - active=true
     * @param $product
     * @param $id
     * @param string $change
     */
    public function changeCover($product, $image, $action=null)
    {
        $collection = $product->images;

        $output = ['cover' => 0];
        $input  = ['cover' => 1];
        $alert  = null;
        $count  = $collection->count();
        $true   = constLang('active_true');
        $false  = constLang('active_false');
        $count_active = collect($collection)->where('active', $true)->count();
        $first_active = collect($collection)->where('active', $true)->first();
        $first_inactive = collect($collection)->where('active', $false)->first();
        $cover_active = collect($collection)->where('cover', 1)->first();

        if ($action == 'create') {
            if ($count >= 1) {
                if ($count_active >= 1) {
                    if ($cover_active) {
                        $data = $cover_active->update($output);
                    }
                }
            }
        } else if ($action == 'update_'.constLang('active_false').'_0') {
            $image_diff = collect($collection)->where('id', '!=', $image->id)->first();
            $last_active = collect($collection)->where('active', $true)->last();
            if ($first_active) {
                if ($first_active->id != $image->id) {
                    $data  = $first_active->update($input);
                }
            } else if ($last_active) {
                if ($last_active->id != $image->id) {
                    $data  = $last_active->update($input);
                }
            } else if ($first_inactive) {
                if ($first_inactive->id != $image->id) {
                    $data = $first_inactive->update($input);
                }
            } else if ($first_inactive) {
                if ($first_inactive->id != $image->id) {
                    $data = $first_inactive->update($input);
                }
            }

        } else if ($action == 'delete') {
            $image_diff = collect($collection)->where('id', '!=', $image->id)->first();
            $last_active = collect($collection)->where('active', $true)->last();
            if ($count == 2) {
                $data = $image_diff->update($input);
                $code = $image_diff->code;
                $color = $image_diff->color;
            } else if ($first_active) {
                if ($first_active->id != $image->id) {
                    $data  = $first_active->update($input);
                    $code  = $first_active->code;
                    $color = $first_active->color;
                }
            } else if ($last_active) {
                if ($last_active->id != $image->id) {
                    $data  = $last_active->update($input);
                    $code  = $last_active->code;
                    $color = $last_active->color;
                }
            } else if ($first_inactive) {
                if ($first_inactive->id != $image->id) {
                    $data = $first_inactive->update($input);
                    $code = $first_inactive->code;
                    $color = $first_inactive->color;
                }
            }

            if ($data) {
                $alert = '<span class="silver">' .
                    constLang('alert.cover_new').'<br>' .
                    constLang('code').':'.$code .'<br>' .
                    constLang('color').':'.$color .'</span>';
            }
            return $alert;

        } else if ($action == 'status'){
            $last_active = collect($collection)->where('active', $true)->last();
            if ($count >= 1) {
                if ($count_active >= 1) {
                    $image->update($output);
                    if ($first_active) {
                        if ($first_active->id != $image->id) {
                            $data  = $first_active->update($input);
                            $code  = $first_active->code;
                            $color = $first_active->color;
                        }
                    } else if ($last_active) {
                        if ($last_active->id != $image->id) {
                            $data  = $last_active->update($input);
                            $code  = $last_active->code;
                            $color = $last_active->color;
                        }
                    }
                    $alert = '<span class="silver">' .
                        constLang('alert.cover_new').'<br>' .
                        constLang('code').':'.$code .'<br>' .
                        constLang('color').':'.$color .'</span>';
                }
            } else {
                $alert = '<span class="red">'.constLang('alert.cover_false').'</span>';
            }
            return $alert;
        }

    }



    /**
     * Status
     *
     * @param  array $input
     * @param  int $id
     * @return json
     */
    public function colorsStatus($input, $product, $id)
    {
        $data = $this->model->find($id);

        $update = $data->update($input);
        if ($update) {

            if ($data->active == constLang('active_true')) {
                $alert        = null;
                $status       = constLang('active_true');
                $color_status = 'icon-tick green-gradient">'.constLang('active_true');

            } else {
                $status       = constLang('active_false');
                $color_status = 'grey-gradient">'.constLang('active_false');
                ($data->cover == 1 ? $alert = 'Esta imagem era capa!<br>Coloque outra imagem como capa com o status: Ativo.' : $alert = null);
            }

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    " Alterou o status da cor do Produto:".
                    Str::slug($product->name.'-'.$product->category.'-'.$product->section.'-'.$product->brand).
                    ', para Status:'.$status)
            );

            $clickStatus = "statusColors('{$data->id}','".route('colors-status', ['idpro' => $data->product_id,'id' => $data->id])."','{$data->active}','{$data->cover}','".csrf_token()."')";
            $html = '<p id="status-'.$data->id.'"><button type="button" onclick="'.$clickStatus.'" class="button compact '.$color_status.'</button></p>';

            $out = array(
                "success" => true,
                "message" => "A status foi alterado.",
                "html"  => $html,
                'alert' => $alert
            );

            return $out;
        }

        return array(
            'success' => false,
            'message' => "Não foi possível alterar o status.");
    }








}