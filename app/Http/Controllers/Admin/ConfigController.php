<?php

namespace AVDPainel\Http\Controllers\Admin;


use AVDPainel\Http\Controllers\Controller;
use AVDPainel\Interfaces\Admin\AdminAccessInterface as InterAccess;
use AVDPainel\Interfaces\Admin\ConfigSystemInterface as InterModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConfigController extends Controller
{
    protected $ability  = 'config';
    protected $view     = 'backend.config';


    /**
     * Acesso e Personalização.
     *
     * @return void
     */
    public function __construct(
        InterAccess $access,
        InterModel $interModel)
    {
        $this->middleware('auth:admin');

        $this->access     = $access;
        $this->interModel = $interModel;
    }

    
    /**
     * Página inicial das configurações do sistema.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $register = ["last_url" => 'config/sistema'];
        $this->access->update($register);

        return view("{$this->view}.index");
    }

    /**
     * Personalizar cores do sistema.
     *
     * @return \Illuminate\Http\Response
     */
    public function colorSystem()
    {

        $register = ["last_url" => 'config/cores/sistema'];
        $this->access->update($register);

        $data = $this->interModel->get();
        
        return view("{$this->view}.colors.index", compact('data'));
    }


    public function colorUpdate(Request $request)
    {
        $dataForm = $request->All();
        $update   = $this->interModel->update($dataForm);
        if ($update ) {
            $success = true;
            $message = 'Alteração realizada.';
        } else {
            $success = false;
            $message = 'Não foi possível alterar';
        }

        $out = array(
            "success" => $success,
            "message" => $message
        );

        return response()->json($out);
    }
    

    /**
     * Folders: Seguranca e Permissões
     *
     * @return \Illuminate\Http\Response
     */
    public function folders($name)
    {
        return view("{$this->view}.folders.{$name}");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
