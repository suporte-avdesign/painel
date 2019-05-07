<?php

namespace AVDPainel\Repositories\Admin;

use AVDPainel\Interfaces\Admin\ConfigKeywordInterface as Keywords;

use AVDPainel\Models\Admin\ImagePosition as Model;
use AVDPainel\Interfaces\Admin\ImagePositionInterface;
use Intervention\Image\Facades\Image;


class ImagePositionRepository implements ImagePositionInterface
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
    public function __construct(Model $model, Keywords $keywords)
    {
        $this->model    = $model;
        $this->keywords = $keywords;
        $this->photoUrl = 'storage/';
        $this->disk     = storage_path('app/public/');

    }

    /**
     * Init Model
     *
     * @return array
     */
    public function get($id)
    {
        $data  = $this->model->where('image_color_id', $id)->get();
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

        $ext      = $file->getClientOriginalExtension();
        $name     = $input['name'].'-'.numLetter(date('Ymdhs'), 'letter').'.'.$ext;

        foreach ($config as $value) {
            if ($value->type == 'P') {
                $width    = $value->width;
                $height   = $value->height;
                $path     = $this->disk . $value->path;
                $upload = Image::make($file)->resize($width, $height)->save($path.$name);

            }
        }          
           
        if ($upload) {

            $input['image'] = $name;
            
            $data = $this->model->create($input);
            if ($data) {

                if ( $data->active == 1 ) {
                    $status = 'Ativo';
                    $col    = 'green';

                } else {
                    $status = 'Inativo';
                    $col    = 'red';
                }

                foreach ($config as $value) {
                    if ($value->default == 'N') {
                        $src = $this->photoUrl . $value->path;
                    }
                }

                $click_status = "statusPosition('{$data->id}', '".route('status-position', $data->id)."', '{$data->active}', '".csrf_token()."')";
                $click_edit   = "abreModal('Editar: Posição', '".route('positions-product.edit', ['idimg' => $data->image_color_id,'id' => $data->id])."', 'form-positions', 2, 'true',800,780)";
                $click_delete = "deletePosition('{$data->id}', '".route('positions-product.destroy', ['idimg' => $data->image_color_id, 'id' => $data->id])."')";

                $html = '<li id="img-positions-'.$data->id.'">';
                    $html .= '<img src="'.url($src.$data->image).'" class="framed"/>';
                    $html .= '<div class="controls">';
                        $html .= '<span id="btns-'.$data->id.'" class="button-group compact children-tooltip">';

                            $html .= '<button id onclick="'.$click_status.'" class="button icon-tick '.$col.'-gradient" title="Alterar status"></button>';
                            $html .= '<button onclick="'.$click_edit.'" class="button" title="Editar imagem">Editar</button>';
                            $html .= '<button onclick="'.$click_delete.'" class="button icon-trash red-gradient" title="Excluir imagem"></button>';
                        
                        $html .= '</span>';
                    $html .= '</div>';
                $html .= '</li>';

                $data['html'] = $html;

                $color = $this->model->find($data->id)->color;

                generateAccessesTxt(date('H:i:s').utf8_decode(
                    ', Adicionou a imagem posição do Produto:'.$color->slug.
                    ', Código:'.$color->code.
                    ', Cor:'.$color->code.
                    ', Status:'.$status)
                );
                return $data;
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

        $data = $this->model->find($id);
        $corrent_name = substr($data->image, 0, -4);

        if (!empty($file)) {

            foreach ($config as $value) {
                $image = $this->disk.$value->path.$data->image;
                if (file_exists($image)) {
                    $delete = unlink($image);
                }
            }

            $ext  = $file->getClientOriginalExtension();
            $name = $corrent_name.numLetter(date('Ymdhs'),'letter').'.'.$ext;        
            foreach ($config as $value) {
                if ($value->type == 'P') {
                    $width    = $value->width;
                    $height   = $value->height;
                    $path     = $this->disk . $value->path;
                    $upload = Image::make($file)->resize($width, $height)->save($path.$name);
                }
            }

            if ($upload) {
                $input['image'] = $name;
            }
        }

        $update = $data->update($input);
        if ($update) {

            if ( $data->active == 1 ) {
                $status = 'Ativo';
                $col    = 'green';

            } else {
                $status = 'Inativo';
                $col    = 'red';
            }

            foreach ($config as $value) {
                if ($value->default == 'N') {
                    $src = $this->photoUrl.$value->path;
                }
            }

            $click_status = "statusPosition('{$data->id}', '".route('status-position', $data->id)."', '{$data->active}', '".csrf_token()."')";
            $click_edit   = "abreModal('Editar: Posição', '".route('positions-product.edit', ['idimg' => $data->image_color_id,'id' => $data->id])."', 'form-positions', 2, 'true',800,780)";
            $click_delete = "deletePosition('{$data->id}', '".route('positions-product.destroy', ['idimg' => $data->image_color_id, 'id' => $data->id])."')";

            $html  = '<img src="'.url($src.$data->image).'" class="framed"/>';
            $html .= '<div class="controls">';
                $html .= '<span id="btns-'.$data->id.'" class="button-group compact children-tooltip">';
                    $html .= '<button id onclick="'.$click_status.'" class="button icon-tick '.$col.'-gradient" title="Alterar status"></button>';
                    $html .= '<button onclick="'.$click_edit.'" class="button" title="Editar imagem">Editar</button>';
                    $html .= '<button onclick="'.$click_delete.'" class="button icon-trash red-gradient" title="Excluir imagem"></button>';
                $html .= '</span>';
            $html .= '</div>';

            $data['html'] = $html;

            (!empty($file) ? $text = ', Alterou a imagem' : $text = ', Alterou os dados da imagem');
            ($data->active == 1 ? $status = 'Ativo' : $status = 'Inativo');
            generateAccessesTxt(date('H:i:s').utf8_decode($text.
                ' da Posição:'.$corrent_name.
                ', Status:'.$status)
            );

            return $data;
        }

        return false;        
    }

    /**
     * Remove
     *
     * @param  int $id
     * @return boolean true or false
     */
    public function delete($id, $config)
    {

        $data  = $this->model->find($id);
        $color = $data->color;

        foreach ($config as $value) {
            if ($value->type == 'P') {
                $image = $this->disk.$value->path.$data->image;

                if (file_exists($image)) {
                    $remove = unlink($image);
                }
            }
        }

        $delete = $data->delete();            

        if ($delete) {

            ($data->active == 1 ? $status = 'Ativo' : $status = 'Inativo');

            generateAccessesTxt(
                date('H:i:s').utf8_decode(' Excluiu a imagem Posicao:'.$color->slug)
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
    public function status($input, $id)
    {
        $data   = $this->model->find($id);
        $update = $data->update($input);
        $html   = '';

        if ($update) {

            if ( $data->active == 1 ) {
                $status = 'Ativo';
                $col    = 'green';

            } else {
                $status = 'Inativo';
                $col    = 'red';
            }

            $click_status = "statusPosition('{$data->id}', '".route('status-position', $data->id)."', '{$data->active}', '".csrf_token()."')";
            $click_edit   = "abreModal('Editar: Posição', '".route('positions-product.edit', ['idimg' => $data->image_color_id,'id' => $data->id])."', 'form-positions', 2, 'true',800,780)";
            $click_delete = "deletePosition('{$data->id}', '".route('positions-product.destroy', ['idimg' => $data->image_color_id, 'id' => $data->id])."')";

            $html .= '<button id onclick="'.$click_status.'" class="button icon-tick '.$col.'-gradient" title="Alterar status"></button>';
            $html .= '<button onclick="'.$click_status.'" class="button" title="Editar imagem">Editar</button>';
            $html .= '<button onclick="'.$click_status.'" class="button icon-trash red-gradient" title="Excluir imagem"></button>';
            
            generateAccessesTxt(
                date('H:i:s').utf8_decode(' Alterou o status da imagem posição para '.$status)
            );

            $out = array(
                "success"    => true,
                "message"    => "A status foi alterado.",
                "html"      => $html
            );               

            return $out;
        }

        return array(
            'success' => false,
            'message' => "Não foi possível alterar o status.");

    }

}