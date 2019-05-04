<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Http\Requests\Admin\ProductPositionRequest as ReqModel;

use AVDPainel\Interfaces\Admin\ConfigImageProductInterface as ConfigImage;
use AVDPainel\Interfaces\Admin\ImagePositionInterface as InterModel;
use AVDPainel\Interfaces\Admin\ImageColorInterface as InterColor;
use AVDPainel\Interfaces\Admin\ProductInterface as InterProduct;

use AVDPainel\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ImagePositionController extends Controller
{

    protected $ability = 'product-images';
    protected $view    = 'backend.products';

    public function __construct(
        InterModel  $interModel,
        ConfigImage $configImage)
    {
        $this->middleware('auth:admin');

        $this->configImage   = $configImage;
        $this->interModel    = $interModel;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InterProduct $interProduct, $idpro)
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $configImage  = $this->configImage->setName('default', 'N');
        $product      = $interProduct->setId($idpro);
        $colors       = $product->images;
        $path         = $configImage->path;

        (count($colors) >= 1 ? $title_count = 'Clique na imagem para editar' :
                               $title_count = 'Não existe imagem para este produto');

        return view("{$this->view}.gallery-positions", compact('colors','path','idpro', 'title_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idpro)
    {

    }

    /**
     * Store 
     *
     * @param  \AVDPainel\Http\Requests\Admin\ProductColorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReqModel $request, $idpro)
    {

        $dataForm = $request['pos'];
        $action   = $request['ac'];
        $file     = $request->file('file');
        $config   = $this->configImage->get();
        $data     = $this->interModel->create($dataForm, $config, $file);
        
        if ($data) {
            $success  = true;
            $message  = 'Posição foi adicionada.';
            $color_id = $data->image_color_id;
            $html     = $data->html;
        
        } else {
            $success  = true;
            $message  = 'Posição foi adicionada.';
            $color_id = null;
            $html     = null;
        }

        $out = array(
            'success' => $success,
            'message' => $message,
            'ac' => $action,
            'html' => $html,
            'color_id' => $color_id
        );


        return response()->json($out);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idimg, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idimg, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $configImage = $this->configImage->setName('default', 'N');
        $path        = $configImage->path;
        $data        = $this->interModel->setId($id);


        return view("{$this->view}.modal.forms.positions", compact('data', 'idimg', 'path'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AVDPainel\Http\Requests\Admin\ProductColorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idimg, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $file      = $request->file('file');
        $config    = $this->configImage->get();
        $action    = $request['ac'];
        $dataForm  = $request['pos'];

        $data = $this->interModel->update($dataForm, $id, $config, $file);
       
        if ($data) {

            $success = true;
            $message = 'A posição foi alterada.';
            $id      =  $data->id;
            $html    =  $data->html;

        } else {

            $success = false;
            $message = 'Não foi possível alterar a permissão.';
            $id      = null;
            $html    = null;
        }

        $out = array(
            'success' => $success,
            'message' => $message,
            'ac'      => $action,
            'id'      => $id,
            'html'    => $html
        );

        return response()->json($out);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idimg, $id)
    {
        if( Gate::denies("{$this->ability}-delete") ) {
            return view("backend.erros.message-401");
        }

        $config = $this->configImage->get();

        $delete = $this->interModel->delete($id, $config);
        if ($delete) {
            $success = true;
            $message = 'A imagem foi excluida';
        } else {
            $success = false;
            $message = 'Não foi possível excluir a imagem';
        }

        $out = array(
            'success' => $success,
            'message' => $message
        );

        return response()->json($out);
    }

    /**
     * Add
     *
     * @param  int  $idimg
     * @return \Illuminate\Http\Response
     */
    public function addPosition(InterColor $interColor, $idimg)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $color   = $interColor->setId($idimg);
        $product = $color->product;
        $idpro   = $product->category_id;

        return view("{$this->view}.modal.forms.positions", compact('color', 'idpro'));
    }






    /**
     * Status Image
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idimg
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $dataForm = $request->all();
        $status   = $this->interModel->status($dataForm, $id);

        return response()->json($status);
    }   
}