<?php

namespace AVDPainel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AVDPainel\Http\Controllers\Controller;
use AVDPainel\Interfaces\Admin\adminInterface as InterModel;


class MyProfileAdminController extends Controller
{
    protected $ability = 'model-users';
    protected $view    = 'backend.users';

    public function __construct(
        InterModel $interModel)
    {
        $this->middleware('auth:admin');

        $this->interModel = $interModel;
    }

   /**
     * Mostra o perfil do usuário logado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

}
