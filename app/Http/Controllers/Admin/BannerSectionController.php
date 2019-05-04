<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\ConfigSectionInterface as InterConfig;
use AVDPainel\Interfaces\Admin\ImageSectionInterface as InterModel;
use AVDPainel\Http\Controllers\AdminAjaxDataParamController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BannerSectionController extends AdminAjaxDataParamController
{

    protected $ability = 'section-images';
    protected $view    = 'backend.sections.images';
    protected $upload;

    public function __construct(
        InterModel $interModel,
        InterConfig $interConfig)
    {
        $this->middleware('auth:admin');

        $this->interConfig   = $interConfig->setId(1);
        $this->interModel    = $interModel;
        $this->upload  = array(
            'name'   => 'image',
            'type'   => 'banner',
            'width'  => $this->interConfig->width_banner,
            'height' => $this->interConfig->height_banner,
            'path'   => $this->interConfig->path.
                        $this->interConfig->width_banner.'x'.
                        $this->interConfig->height_banner.'/',
            "btn"   => array(
                "create" => "Adicionar",
                "edit"   => "Editar",
                "status" => "Alterar Status",
                "delete" => "Excluir Imagem"
            )
        );

        $this->messages = array(
            'section_id.required'   => 'A seção é obrigatória',
            'image.required'        => 'A imagem banner é obrigatória.',
            'image.image'           => 'O arquivo deverá conter uma imagem',
            'image.mimes'           => ' dos tipos jpg,gif,png.',
            'image.unique'          => 'Já existe banner para este seção.',
            'type.required'         => 'O tipo é obrigatório',
            'status.required'       => 'O status é obrigatório',
            'title_index'           => 'Banner da Seção',
            'delete_success'        => 'O banner foi excluido.',
            'delete_error'          => 'Não foi possível excluir o banner.',
            'upload_false'          => 'Não foi possível fazer upload da imagem.'
        );
    }



    public function status(Request $request, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $dataForm = $request->all();
        $status = $this->interModel->status($id);

        return response()->json($status);
    }   
}