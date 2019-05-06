<?php

namespace AVDPainel\Repositories\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use AVDPainel\Models\Admin\ImageColor as Model;
use AVDPainel\Interfaces\Admin\ImageColorInterface;
use AVDPainel\Interfaces\Admin\ConfigKeywordInterface as Keywords;
use AVDPainel\Interfaces\Admin\ConfigImageProductInterface as ConfigImage;

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
        $this->model         = $model;
        $this->keywords      = $keywords;
        $this->configImage   = $configImage;
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
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'" src="'.url($path.$val->image).'" width="80" /></a>';
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
                    $image = '<a href="javascript:void(0)"><img id="img-'.$val->id.'" src="'.url($path.$val->image).'" width="80" /></a>';
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
            generateAccessesTxt(
                date('H:i:s').utf8_decode(' Alterou o Produto:'.$data->slug.  
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
     * Create
     *
     * @param  array $input
     * @param  array $config
     * @param  file $file
     * @return array
     */
    public function create($input, $config, $file)
    {
        // if < 10 add 0 in front
        $count = strlen($input['order']);
        if ($count == 1) {
            $input['order'] = '0'.$input['order'];
        }

        if ($input['cover'] == 1) {
            $change = $this->changeCover($input['product_id']);
        }

        $words    = $this->keywords->rand();
        $code     = $input['code'];
        $color    = $input['color'];
        $brand    = $input['brand'];
        $section  = $input['section'];
        $product  = $input['product_name'];
        $category = $input['category'];



        $ext  = $file->getClientOriginalExtension();
        $name = Str::slug($words['description'].
            '-'.$product.
            '-'.$category.
            '-'.$section.
            '-'.str_replace("/", "-", $color).
            '-'.$brand.
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
            $input['image'] = $name;
            $input['slug']  = date('Ymdhs');
            $data = $this->model->create($input);
            if ($data) {
                $slug = [
                    'slug' => Str::slug($product.
                        '-'.$category.
                        '-'.$section.
                        '-'.str_replace("/", "-", $data->color).
                        '-'.$brand.                        
                        '-'.numLetter($data->id, 'letter').
                        '-'.$data->code)
                ];
                $update = $data->update($slug);

                if ($update) {
                    ($data->active == 1 ? $status = 'Ativo' : $status = 'Inativo');
                    ($data->cover == 1 ? $cover = 'Sim' : $cover = 'Não');
                    generateAccessesTxt(date('H:i:s').utf8_decode(
                        ' Adicionou a imagem do Produto:'.Str::slug($product.
                        '-'.$category.
                        '-'.$section.
                        '-'.$brand).
                        ', Código:'.$data->code.
                        ', Cor:'.$data->color.
                        ', Status:'.$status.
                        ', Capa:'.$cover)
                    );

                    foreach ($config as $value) {
                        if ($value->default == 'N') {
                            $src = $this->photoUrl . $value->path;
                        }
                    }

                    ($data->active == 1 ? $col = 'green-gradient' : $col = 'red-gradient');
                    ($data->cover == 1 ? $title = 'capa' : $title = '');
                    ($data->cover == 1 ? $option = '{"classes":["red-gradient"],"position":"top"}' : $option = '');

                    $click_status = "statusColor('{$data->id}', '".route('status-color', ['idpro' => $data->product_id,'id' => $data->id])."', '{$data->active}','{$data->cover}','".csrf_token()."')";
                    $click_edit   = "abreModal('Editar: Cor {$data->color}', '".route('colors-product.edit', ['idpro' => $data->product_id,'id' => $data->id])."', 'form-colors', 2, 'true',800,780)";
                    $click_delete = "deleteColor('$data->id', '".route('colors-product.destroy', ['idpro' => $data->product_id, 'id' =>$data->id])."')";
                    
                    $html = '<li id="img-colors-'.$data->id.'">';
                        $html .= '<img src="'.url($src.$data->image).'" class="framed">';
                        $html .= '<div class="controls">';
                            $html .= '<span id="btns-'.$data->id.'" class="button-group compact children-tooltip" data-tooltip-options='.$option.'>';
                                $html .= '<button onclick="'.$click_status.'" class="button icon-tick '.$col.'" title="Alterar status "'.$title.'"></button>';
                                $html .= '<button onclick="'.$click_edit.'" class="button" title="Editar imagem '.$title.'">Editar</button>';
                                $html .= '<button onclick="'.$click_delete.'" class="button icon-trash red-gradient" title="Excluir imagem '.$title.'"></button>';
                            $html .= '</span>';
                        $html .= '</div>';
                    $html .= '</li>';

                    $data['html'] = $html;

                    return $data;

                } else {
                    return  false;
                }
            }
        }

        return false;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  array $input
     * @param  int $id
     * @param  array $config 
     * @param  file $file
     * @return array
     */
    public function update($input, $id, $config, $file)
    {
        // if < 10 add 0 in front
        $count = strlen($input['order']);
        if ($count == 1) {
            $input['order'] = '0'.$input['order'];
        }

        if ($input['cover'] == 1) {
            $change = $this->changeCover($input['product_id']);
        }

        if ($input['kit'] == 0) {
            $input['kit_name'] = null;
        }

        $data     = $this->model->find($id);
        
        $code     = $input['code'];
        $color    = $input['color'];
        $brand    = $input['brand'];
        $section  = $input['section'];
        $product  = $input['product_name'];
        $category = $input['category'];

        if (!empty($file)) {

            foreach ($config as $value) {
                $image = $this->disk.$value->path.$data->image;
                if (file_exists($image)) {
                    $delete = unlink($image);
                }
            }

            $words    = $this->keywords->rand();
            $ext  = $file->getClientOriginalExtension();
            $name = Str::slug($words['description'].
                '-'.$product.
                '-'.$category.
                '-'.$section.
                '-'.str_replace("/", "-", $color).
                '-'.$brand.
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
                $input['image'] = $name;
                $input['slug'] = Str::slug($product.
                    '-'.$category.
                    '-'.$section.
                    '-'.str_replace("/", "-", $color).
                    '-'.$brand.                        
                    '-'.numLetter($data->id, 'letter').
                    '-'.$code);
            }

        }

        $update = $data->update($input);
        if ($update) {
            (!empty($file) ? $text = ', Alterou a imagem' : $text = ', Alterou os dados da imagem');
            ($data->active == 1 ? $status = 'Ativo' : $status = 'Inativo');
            ($data->cover == 1 ? $cover = 'Sim' : $cover = 'Não');
            generateAccessesTxt(date('H:i:s').utf8_decode($text.
                ' do Produto:'.Str::slug($input['product_name'].
                '-'.$category.
                '-'.$section.
                '-'.$brand).
                ', Código:'.$data->code.
                ', Cor:'.$data->color.
                ', Status:'.$status.
                ', Capa:'.$cover)
            );

            foreach ($config as $value) {
                if ($value->default == 'N') {
                    $src = $this->photoUrl.$value->path;
                }
            }

            ($data->active == 1 ? $col = 'green-gradient' : $col = 'red-gradient');
            ($data->cover == 1 ? $title = 'capa' : $title = '');
            ($data->cover == 1 ? $option = '{"classes":["red-gradient"],"position":"top"}' : $option = '');

            $click_status = "statusColor('{$data->id}', '".route('status-color', ['idpro' => $data->product_id,'id' => $data->id])."', '{$data->active}','{$data->cover}','".csrf_token()."')";
            $click_edit   = "abreModal('Editar: Cor {$data->color}', '".route('colors-product.edit', ['idpro' => $data->product_id,'id' => $data->id])."', 'form-colors', 2, 'true',800,780)";
            $click_delete = "deleteColor('$data->id', '".route('colors-product.destroy', ['idpro' => $data->product_id, 'id' =>$data->id])."')";
            
            $html = '<img src="'.url($src.$data->image).'" class="framed">';
            $html .= '<div class="controls">';
                $html .= '<span id="btns-'.$data->id.'" class="button-group compact children-tooltip" data-tooltip-options='.$option.'>';
                    $html .= '<button onclick="'.$click_status.'" class="button icon-tick '.$col.'" title="Alterar status "'.$title.'"></button>';
                    $html .= '<button onclick="'.$click_edit.'" class="button" title="Editar imagem '.$title.'">Editar</button>';
                    $html .= '<button onclick="'.$click_delete.'" class="button icon-trash red-gradient" title="Excluir imagem '.$title.'"></button>';
                $html .= '</span>';
            $html .= '</div>';

            $data['html']   = $html;
            // Module All Colors
            $data['image']  = url($src.$data->image);

            return $data;
        }


        return false;
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
                    $image = $value->path.$position->image;
                    if (file_exists($image)) {
                        $remove = unlink($image);
                    }
                }
            }

            if ($value->type == 'C') {
                $color = $value->path.$data->image;
                if (file_exists($color)) {
                    $remove = unlink($color);
                }
            }
        }

        $this->changeCover($data->product_id, true);

        $delete = $data->delete();            

        if ($delete) {

            ($data->active == 1 ? $status = 'Ativo' : $status = 'Inativo');
            ($data->cover == 1 ? $cover = 'Sim' : $cover = 'Não');

            generateAccessesTxt(
                date('H:i:s').utf8_decode(' Excluiu a imagem do Produto:'.Str::slug($product->name.
                '-'.$product->category.'-'.$product->section.'-'.$product->brand).  
                ', Código:'.$data->code.
                ', Cor:'.$data->color.
                ', Status:'.$status.
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
            if( $data->active == 1 ) {
                $col = 'green-gradient';
                $status = 'Ativo';
            } else {
                $col = 'red-gradient';
                $status = 'Inativo';
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


            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                " Alterou o status da cor do Produto:".
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

            if ($data->active == 1) {
                $alert        = null;
                $status       = 'Ativo';
                $color_status = 'icon-tick green-gradient">Ativo';

            } else {
                $status       = 'Inativo';
                $color_status = 'grey-gradient">Inativo';
                ($data->cover == 1 ? $alert = 'Esta imagem era capa!<br>Coloque outra imagem como capa com o status: Ativo.' : $alert = null);
            }

            generateAccessesTxt(
                date('H:i:s').utf8_decode(
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