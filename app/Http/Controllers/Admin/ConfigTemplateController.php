<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\ConfigTemplateInterface as InterModel;
use AVDPainel\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;


class ConfigTemplateController extends Controller
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
                'type' => 'Tipo',
                'page' => 'Página',
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
            'select_text' => 'Selecione um..',

            'create_model' => array(
                "create" => "Modulo",
                "title" => "Adicionar Modulo"
            ),
            'create_page' => array(
                "create" => "Página",
                "title" => "Adicionar Página"
            ),
            'edit_model' => "Editar Modulo",
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



    public function index(ConfigPage $configPage)
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $config = $this->messages;

        $pages = $configPage->orderBy('name')->get();

        return view("{$this->view}.index", compact('config','pages'));
    }




    /**
     * Adicionar Modulo.
     *
     * @return View
     */
    public function create()
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $pages = \AVDPainel\Models\Admin\ConfigPage::orderBy('name')->get();

        $config = $this->messages;

        return view("{$this->view}.form-module-create", compact('config','pages'));
    }



    /**
     * Salvar Modulo
     *
     * @param Request $request
     * @return json
     */
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
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
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
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
