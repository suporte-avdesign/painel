<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\ConfigPageInterface as InterModel;
use AVDPainel\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;

class ConfigPageController extends Controller
{

    protected $content = 'Configuração: Template do Site';
    protected $ability = 'config-site';
    protected $view    = 'backend.config.template';
    protected $model;

    public function __construct(InterModel $interModel)
    {

        $this->middleware('auth:admin');

        $this->interModel = $interModel;

        $this->messages = array(
            "fields" => array(
                'name' => 'Nome',
                'module' => "Modulo",
                'status' => 'Status'
            ),
            "accesses" => array(
                'create' => "Adicionou {$this->content} ",
                'update' => "Alterou {$this->content} ",
                'delete' => "Excluiu {$this->content} ",
            ),
            'name.required' => 'A página é obrigatória',
            'name.unique' => 'Já existe uma página com este nome',
            'module.required' => 'O modulo é obrigatório',
            'status.required' => 'O status é obrigatório',
            'title_index' => $this->content,
            'title_page' => "Adicionar Página",
            'title_model' => "Adicionar Modulo",
            'text_page' => "Página",
            'text_model' => "Mólulo",
            'edit_page' => "Editar Página",
            'create_true' => 'O registro foi salvo',
            'create_false' => 'Não foi possível salvar o registro',
            'update_true' => 'O registro foi alterado',
            'update_false' => 'Não foi possível alterar o registro',
            'delete_true' => 'O registro foi excluido',
            'delete_false' => 'Não foi possível excluir o registro',
            'status_true' => 'O status foi alterado',
            'status_false' => 'Não foi possível alterar o status',
            'error_serve' => 'Houve um erro no servidor.'
        );
    }


    public function index()
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $config = $this->messages;

        $pages = $this->interModel->getAll();

        return view("{$this->view}.index", compact('config','pages'));
    }


    public function load()
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $config = $this->messages;

        $pages = $this->interModel->getAll();

        return view("{$this->view}.load", compact('config','pages'));
    }


    /**
     * Adicionar Page.
     *
     * @return View
     */
    public function create()
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $config = $this->messages;

        return view("{$this->view}.form-page-create", compact('config'));
    }




    public function store(Request $request)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $this->interModel->rules($request, $this->messages);

        $dataForm = $request->all();

        $create = $this->interModel->create($dataForm, $this->messages);

        return response()->json($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AVDPainel\Models\Admin\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigPage $configPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AVDPainel\Models\Admin\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigPage $configPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AVDPainel\Models\Admin\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigPage $configPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AVDPainel\Models\Admin\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigPage $configPage)
    {
        //
    }
}
