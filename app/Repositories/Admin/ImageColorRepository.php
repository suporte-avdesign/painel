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
     * Init Model
     *
     * @return array
     */
    public function get($id)
    {
        $data  = $this->model->where('product_id', $id)->get();
        return $data;    
    }

    /**
     * Change image cover
     *
     * @param  int $idpro
     * @param  int $id
     * @return void
     */
    public function changeCover($id, $change ='')
    {
        $data = $this->model->where('product_id', $id)->get();
        if (count($data) >= 1) {
            foreach ($data as $value) {
                $input = ['cover' => 0];
                $this->model->find($value->id)->update($input);
            }

            if ($change) {
                $update = $this->model->where('product_id', $id)
                            ->first()->update(['cover' => 1]);
            }            

        }
    }

    /**
     * Change Grids
     *
     * @param  int $input
     * @param  int $id
     * @return void
     */
    public function changeGrids($input, $id)
    {
        $data   = $this->model->find($id);
        $update = $data->update($input);
        if ($update) {
            ($data->kit == 1 ? $kit = 'Kit' : $kit = 'Unidade');
            generateAccessesTxt(date('H:i:s').utf8_decode(
                ' Alterou o Produto:'.$data->slug.
                ' Para:'.$kit)
            );
            return true;
        }
        return false;
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
     * Date 06/02/2019
     * Falta definir $input['html'] hexa,crop,thumb
     *
     * @param $input
     * @param $config
     * @return mixed
     */
    public function create($input, $config)
    {
        $count = strlen($input['order']);
        if ($count == 1) {
            $dataForm['order'] = '0'.$input['order'];
        }
        if ($input['cover'] == 1) {
            $change = $this->changeCover($input['product_id']);
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


    public function update($input, $config, $image)
    {
        $access   = constLang('accesses.update').' '.constLang('product');
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
        if ($image->cover != $input['cover']) {
            if ($input['cover'] == 1) {
                $change = $this->changeCover($image->product_id);
            }
            $access .= ' '.constLang('cover').':'.$image->cover.'/'.$input['cover'];
        }
        if ($image->order != $input['order']) {
            $dataForm['order'] = $input['order'];
            $access .= ' '.constLang('order').':'.$image->order.'/'.$input['order'];
        }

        if(!empty($dataForm)){
            $update = $image->update($dataForm);
            generateAccessesTxt(
                date('H:i:s').utf8_decode(' '.$access)
            );
            return $update;
        }

        return true;

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
        if ($input['ac'] == 'ceate') {
            $cover = $input['cover'];
            if (count($image) == 1) {
                $dataForm['cover'] = 1;
            } else {
                if ($cover == 0) {
                    $this->changeCover($product->id, true);
                }
            }
        }
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
            $render = view('backend.colors.gallery-render', compact('image', 'path'))->render();
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
     * Remove
     *
     * @param  int $id
     * @param  int $product
     * @param  array $config
     * @return json
     */
    public function delete($id, $product, $config)
    {
        $data      = $this->model->find($id);
        $positions = $data->positions;

        foreach ($config as $value) {
            if ($value->type == 'P') {
                foreach ($positions as $position) {
                    $image = $this->disk.$value->path.$position->image;
                    if (file_exists($image)) {
                        $remove = unlink($image);
                    }
                }
            }

            if ($value->type == 'C') {
                /* Copiar  a thumb */
                if ($value->default != 'T') {
                    $color = $this->disk.$value->path.$data->image;
                    if (file_exists($color)) {
                        $remove = unlink($color);
                    }
                }
            }
        }

        $this->changeCover($data->product_id, true);

        $delete = $data->delete();

        if ($delete) {

            ($data->cover == 1 ? $cover = constLang('yes') : $cover = constLang('not'));

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    ' Excluiu a imagem do Produto:'.Str::slug($product->name.
                        '-'.$product->category.'-'.$product->section.'-'.$product->brand).
                    ', Código:'.$data->code.
                    ', Cor:'.$data->color.
                    ', Status:'.$data->active.
                    ', Capa:'.$cover)
            );

            return true;
        }

        return false;
    }


    /**
     * Status
     *
     * @param  array $input
     * @param  int $id
     * @return json
     */
    public function status($input, $product, $id)
    {
        $data = $this->model->find($id);

        $update = $data->update($input);
        if ($update) {
            $alert = null;
            if( $data->active == constLang('active_true') ) {
                $col = 'green-gradient';
                $status = constLang('active_true');
            } else {
                $col = 'red-gradient';
                $status = constLang('active_false');
            }

            if ($data->cover == 1) {
                $title  = 'capa';
                $option = '{"classes":["red-gradient"],"position":"top"}';
                if ($data->active == 0) {
                    $alert = 'Esta imagem era capa!<br>Coloque outra imagem como capa com o status: Ativo.';
                }
            } else {
                $title  = '';
                $option = '';
            }


            generateAccessesTxt(date('H:i:s'). utf8_decode(" Alterou o status da cor do Produto:".
                    Str::slug($product->name.'-'.$product->category.'-'.$product->section.'-'.$product->brand).
                    ', para Status:'.$status)
            );

            $click_status = "statusColor('{$data->id}', '".route('status-color', ['idpro' => $data->product_id,'id' => $data->id])."', '{$data->active}','{$data->cover}','".csrf_token()."')";
            $click_edit   = "abreModal('Editar: Cor {$data->color}', '".route('colors-product.edit', ['idpro' => $data->product_id,'id' => $data->id])."', 'form-colors', 2, 'true',800,780)";
            $click_delete = "deleteColor('$data->id', '".route('colors-product.destroy', ['idpro' => $data->product_id, 'id' =>$data->id])."')";

            $html  = '<button onclick="'.$click_status.'" class="button icon-tick '.$col.'" title="Alterar status "'.$title.'"></button>';
            $html .= '<button onclick="'.$click_edit.'" class="button" title="Editar imagem '.$title.'">Editar</button>';
            $html .= '<button onclick="'.$click_delete.'" class="button icon-trash red-gradient" title="Excluir imagem '.$title.'"></button>';

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