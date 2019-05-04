<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\AdminAccessInterface as InterAccess;
use AVDPainel\Interfaces\Admin\GridCategoryInterface as InterModel;
use AVDPainel\Http\Controllers\AdminAjaxDataParamController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GridCategoryController extends AdminAjaxDataParamController
{

    protected $ability      = 'category-grids';
    protected $view         = 'backend.categories.grids';


    public function __construct(InterModel $interModel)
    {
        $this->middleware('auth:admin');

        $this->interModel   = $interModel;
        $this->messages     = array(
            'name.required'  => 'A categoria é obrigatória.',
            'label.required' => 'A grade é obrigatória.',
            'title_index'    => 'Grades da Categoria',
            'delete_success' => 'A grade foi excluida.',
            'delete_error'   => 'Não foi possível excluir a grade.'
        );
    }
}
