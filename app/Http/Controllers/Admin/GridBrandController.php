<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\AdminAccessInterface as InterAccess;
use AVDPainel\Interfaces\Admin\GridBrandInterface as InterModel;
use AVDPainel\Http\Controllers\AdminAjaxDataParamController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GridBrandController extends AdminAjaxDataParamController
{

    protected $ability      = 'brand-grids';
    protected $view         = 'backend.brands.grids';


    public function __construct(InterModel $interModel)
    {
        $this->middleware('auth:admin');

        $this->interModel   = $interModel;
        $this->messages     = array(
            'type.required'  => 'O tipo é obrigatório.',
            'name.required'  => 'A categoria é obrigatória.',
            'label.required' => 'A grade é obrigatória.',
            'title_index'    => 'Grades do Fabricante',
            'delete_success' => 'A grade foi excluida.',
            'delete_error'   => 'Não foi possível excluir a grade.'
        );
    }
}
