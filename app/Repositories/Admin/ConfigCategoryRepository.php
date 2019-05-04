<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\ConfigCategory as Model;
use AVDPainel\Interfaces\Admin\ConfigCategoryInterface;

use Illuminate\Foundation\Validation\ValidatesRequests;
use File;

class ConfigCategoryRepository implements ConfigCategoryInterface
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
    

    public function get($value, $id)
    {
        $data = $this->model->find($id);
        return $data->value;
    }


    public function setId($id)
    {
        return $this->model->find($id);
    }


    public function update($input, $id)
    {
        $path = $input['path'];

        $path_featured = $path.$input['width_featured'].'x'.$input['height_featured'];
        if ( !file_exists(public_path().'/'.$path_featured) ) {
            File::makeDirectory(public_path().'/'.$path_featured, 0777, true);
        }

        $path_banner = $path.$input['width_banner'].'x'.$input['height_banner'];
        if ( !file_exists(public_path().'/'.$path_banner) ) {
            File::makeDirectory(public_path().'/'.$path_banner, 0777, true);
        }

        $data = $this->model->find($id);

        $update = $data->update($input);
        if ($update) {

            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Alterou a configuração das categorias Descrição:'.($data->description == 1 ? 'Ativo' : 'Inativo').
                ', Grades:'.($data->grids == 1 ? 'Ativo' : 'Inativo').
                ', Imagem Padrão:'.($data->img_default == 'B' ? 'Banner' : 'Inativo').
                ', Pasta:'.$data->path.
                ', Img Destaque:'.($data->img_featured == 1 ? 'Ativo' : 'Inativo').
                ', Largura Destaque:'.$data->width_featured.
                ', Altura Destaque:'.$data->height_featured.
                ', Img Banner:'.($data->img_banner == 1 ? 'Ativo' : 'Inativo').
                ', Largura Banner:'.$data->width_banner.
                ', Altura Banner:'.$data->height_banner)
            );
            return true;
        }

        return false;

    }

}