<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\OrderInterface as InterOrder;
use AVDPainel\Interfaces\Admin\OrderShippingInterface as InterModel;
use AVDPainel\Interfaces\Admin\ConfigShippingInterface as ConfigShipping;
use AVDPainel\Interfaces\Admin\ConfigColorPositionInterface as ConfigImages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use AVDPainel\Http\Controllers\Controller;

use PDF;

class OrderShippingController extends Controller
{
    protected $ability  = 'orders';
    protected $view     = 'backend.orders.shippings';
    protected $view_pdf = 'backend.orders';
    protected $disk_pdf;
    protected $url_pdf;
    protected $photo_url;
    protected $messages;

    public function __construct(
        InterOrder $interOrder,
        InterModel $interModel,
        ConfigImages $configImages,
        ConfigShipping $configShipping)
    {
        $this->middleware('auth:admin');

        $this->interOrder     = $interOrder;
        $this->interModel     = $interModel;
        $this->configImages   = $configImages;
        $this->configShipping = $configShipping;
        $this->photo_url       = 'storage/';
        $this->url_pdf       = 'storage/pdf/order';
        $this->disk_pdf      = storage_path('app/public/pdf/order');
        $this->messages = array(
            'config_shipping_id.required' => 'O método é obrigatório.',
            'status.required'             => 'O status é obrigatório.',
            'title_index'                 => 'Método de Envio - Pedido:',
            'title_create'                => 'Adicionar método de envio',
            'title_edit'                  => 'Alterar método de envio',
            'store_true'                  => 'O método de envio foi adicionado.',
            'store_false'                 => 'Não foi possível adicionar o método de envio.',
            'update_true'                 => 'O método de envio foi alterado.',
            'update_false'                => 'Não foi possível alterar o método de envio.',
            'btn_create'                  => 'Adicionar',
            'btn_edit'                    => 'Editar',
            'success_false'               => 'Houve um erro no servidor.'
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }
        $order        = $this->interOrder->setId($id);
        $shippings    = $order->shippings;
        $title        = $this->messages['title_index'];
        $btn_edit     = $this->messages['btn_edit'];
        $btn_create   = $this->messages['btn_create'];
        $title_edit   = $this->messages['title_edit'];
        $title_create = $this->messages['title_create'];


        return view("{$this->view}.index", compact(
            'order',
            'title',
            'shippings',
            'btn_edit',
            'btn_create',
            'title_edit',
            'title_create'
        ));
    }

    /**
     * @param $order_id
     * @return View
     */
    public function create($order_id)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $options = $this->configShipping->pluck('name','id');


        return view("{$this->view}.form-create", compact('order_id', 'options'));
    }

    /**
     * @param Request $request
     * @param $order_id
     * @return Json
     */
    public function store(Request $request, $order_id)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $this->interModel->rules($request, $this->messages);

        $dataForm = $request->all();

        $order = $this->interOrder->setId($order_id);

        $dataForm['order_id'] = $order->id;
        $dataForm['user_id']  = $order->user_id;

        $data = $this->interModel->create($dataForm);
        if ($data) {

            $this->generatePdf($order_id);

            $success = true;
            $message = $this->messages['store_true'];
        } else {
            $success = true;
            $message = $this->messages['store_false'];
        }

        $out = array(
            'success' => $success,
            'message' => $message
        );

        return response()->json($out);
    }

    /**
     * @param $id
     * @param $order_id
     * @return View
     */
    public function show($id, $order_id)
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $order        = $this->interOrder->setId($order_id);
        $shippings    = $order->shippings;
        $title        = $this->messages['title_index'];
        $btn_edit     = $this->messages['btn_edit'];
        $btn_create   = $this->messages['btn_create'];
        $title_edit   = $this->messages['title_edit'];
        $title_create = $this->messages['title_create'];

        return view("{$this->view}.show", compact(
            'order',
            'title',
            'shippings',
            'btn_edit',
            'btn_create',
            'title_edit',
            'title_create'
        ));
    }

    /**
     * @param $id
     * @param $order_id
     * @return View
     */
    public function edit($id, $order_id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $data    = $this->interModel->setId($id);
        $options = $this->configShipping->pluck('name','id');

        return view("{$this->view}.form-edit", compact('order_id', 'data', 'options'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $order_id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $this->interModel->rules($request, $this->messages, $id);

        $dataForm = $request->all();

        $update = $this->interModel->update($dataForm, $id);
        if( $update ) {

            $this->generatePdf($order_id);

            $success = true;
            $message = $this->messages['update_true'];
        } else {
            $success = false;
            $message = $this->messages['update_false'];
        }


        $out = array(
            "success" => $success,
            "message" => $message
        );
        return response()->json($out);
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


    /**
     * @param $order_id
     * @return string
     */
    public function generatePdf($order_id)
    {
        $order = $this->interOrder->setId($order_id);
        $items = $order->items;
        $notes = $order->notes;
        $year = date('Y', strtotime($order->created_at));
        $shippings = $order->shippings;
        $image = $this->configImages->setName('default', 'T');


        $name = md5($order->id) . md5($order->user_id) . '.pdf';
        $path = "{$this->disk_pdf}/{$year}/{$order->user_id}";
        $file = "{$path}/{$name}";
        $photo_url = $this->photo_url;

        $route = url("{$this->url_pdf}/{$year}/{$order->user_id}/{$name}");

        if (file_exists($file)) {
            $delete = unlink($file);
        }

        $pdf = PDF::loadView("{$this->view_pdf}.pdf",compact(
            'order','items','notes','shippings','image','photo_url'
        ));
        $pdf->save($file);

        return $route;
    }


}
