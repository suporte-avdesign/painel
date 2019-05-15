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
    protected $view    = 'backend.template';
    protected $model;

    public function __construct(InterModel $interModel)
    {

        $this->middleware('auth:admin');

        $this->interModel = $interModel;

        $this->messages = array(
            "fields" => array(
                'type' => 'Tipo',
                'title' => 'Titulo',
                'description' => "Descrição",
                'order' => 'Ordem',
                'status' => 'Status',
                'date' => 'Data'
            ),
            "accesses" => array(
                'create' => "Adicionou {$this->content} ",
                'update' => "Alterou {$this->content} ",
                'delete' => "Excluiu {$this->content} ",
            ),
            'type.required' => 'O tipo é obrigatório',
            'title.required' => 'O titulo é obrigatório',
            'description.required' => 'A descrição é obrigatória',
            'status.required' => 'O status é obrigatório',
            'order.required' => 'A ordem é obrigatória.',
            'order.numeric' => 'A ordem tem que ser numérica.',
            'title_index' => $this->content,
            'title_create' => 'Adicionar',
            'title_edit' => 'Editar',
            'create_true' => 'O registro foi salvo',
            'create_false' => 'Não foi possível salvar o registro',
            'update_true' => 'O registro foi alterado',
            'update_false' => 'Não foi possível alterar o registro',
            'delete_true' => 'O registro foi excluido',
            'delete_false' => 'Não foi possível excluir o registro',
            'error_serve' => 'Houve um erro no servidor.',
            'status_true' => 'O status foi alterado',
            'status_false' => 'Não foi possível alterar o status',
            'order_true' => 'A ordem foi alterada',
            'order_false' => 'Não foi possível alterar a ordem'
        );
    }



    public function index()
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $data   = $this->interModel->getAll();
        $config = $this->messages;

        return view("{$this->view}.index", compact('config','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigTemplate $configTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigTemplate $configTemplate)
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
    public function update(Request $request, ConfigTemplate $configTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AVDPainel\Models\Admin\ConfigTemplate  $configTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigTemplate $configTemplate)
    {
        //
    }
}
