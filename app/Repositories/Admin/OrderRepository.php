<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\Order as Model;
use AVDPainel\Interfaces\Admin\OrderInterface;
use AVDPainel\Interfaces\Admin\OrderNoteInterface as InterNotes;
use AVDPainel\Interfaces\Admin\ConfigFreightInterface as ConfigFreigh;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Validation\ValidatesRequests;

class OrderRepository implements OrderInterface
{
    use ValidatesRequests;

    public $model;

    /**
     * OrderRepository constructor.
     * @param Model $model
     */
    public function __construct(
        Model $model,
        InterNotes $interNotes,
        ConfigFreigh $configFreight)
    {
        $this->model         = $model;
        $this->interNotes    = $interNotes;
        $this->configFreight = $configFreight;
    }

    public function rules($input, $messages, $id='')
    {
        $this->validate($input, $this->model->rules($id), $messages);
    }


    /**
     * @param $request
     * @return array
     */
    public function getAll($request)
    {
        $columns = array(
            0   => 'id',
            1   => 'state',
            2   => 'user_id',
            3   => 'profile',
            4   => 'payment',
            5   => 'subtotal',
            6   => 'status',
            7   => 'created_at',
            8   => 'price_cash',
            9   => 'discount',
            10  => 'freight',
            11  => 'tax',
            12  => 'admin',
            13  => 'ip'
        );

        $totalData = $this->model->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $query = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('config_form_payments', 'config_form_payments.id', '=', 'orders.config_form_payment_id')
                ->join('config_status_payments', 'config_status_payments.id', '=', 'orders.config_status_payment_id')
                ->join('user_addresses', 'user_addresses.user_id', '=', 'orders.user_id')
                ->join('config_profile_clients', 'config_profile_clients.id', '=', 'users.profile_id')
                ->select(
                    'orders.*',
                    'config_form_payments.label as payment',
                    'config_status_payments.label as status',
                    'users.first_name',
                    'users.profile_id',
                    'users.last_name',
                    'users.document1',
                    'users.document2',
                    'users.cell',
                    'users.phone',
                    'users.email',
                    'users.admin',
                    'config_profile_clients.name as profile',
                    'user_addresses.delivery',
                    'user_addresses.address',
                    'user_addresses.number',
                    'user_addresses.complement',
                    'user_addresses.district',
                    'user_addresses.city',
                    'user_addresses.state',
                    'user_addresses.zip_code')
                ->whereNull('orders.deleted_at')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();


        } else {

            $search = $request->input('search.value');

            $query = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('config_form_payments', 'config_form_payments.id', '=', 'orders.config_form_payment_id')
                ->join('config_status_payments', 'config_status_payments.id', '=', 'orders.config_status_payment_id')
                ->join('user_addresses', 'user_addresses.user_id', '=', 'orders.user_id')
                ->join('config_profile_clients', 'config_profile_clients.id', '=', 'users.profile_id')
                ->select(
                    'orders.*',
                    'config_form_payments.label as payment',
                    'config_status_payments.label as status',
                    'users.first_name',
                    'users.profile_id',
                    'users.last_name',
                    'users.document1',
                    'users.document2',
                    'users.cell',
                    'users.phone',
                    'users.email',
                    'users.admin',
                    'config_profile_clients.name as profile',
                    'user_addresses.delivery',
                    'user_addresses.address',
                    'user_addresses.number',
                    'user_addresses.complement',
                    'user_addresses.district',
                    'user_addresses.city',
                    'user_addresses.state',
                    'user_addresses.zip_code')
                ->where('orders.id','LIKE',"%{$search}%")
                ->orWhere('orders.user_id','LIKE',"%{$search}%")
                ->orWhere('users.first_name','LIKE',"%{$search}%")
                ->orWhere('users.last_name','LIKE',"%{$search}%")
                ->orWhere('users.email','LIKE',"%{$search}%")
                ->orWhere('users.document1','LIKE',"%{$search}%")
                ->orWhere('users.phone','LIKE',"%{$search}%")
                ->orWhere('users.cell','LIKE',"%{$search}%")
                ->orWhere('user_addresses.city','LIKE',"%{$search}%")
                ->whereNull('orders.deleted_at')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('config_form_payments', 'config_form_payments.id', '=', 'orders.config_form_payment_id')
                ->join('config_status_payments', 'config_status_payments.id', '=', 'orders.config_status_payment_id')
                ->join('user_addresses', 'user_addresses.user_id', '=', 'orders.user_id')
                ->join('config_profile_clients', 'config_profile_clients.id', '=', 'users.profile_id')
                ->select(
                    'orders.*',
                    'config_form_payments.label as payment',
                    'config_status_payments.label as status',
                    'users.first_name',
                    'users.profile_id',
                    'users.last_name',
                    'users.document1',
                    'users.document2',
                    'users.cell',
                    'users.phone',
                    'users.email',
                    'users.admin',
                    'config_profile_clients.name as profile',
                    'user_addresses.delivery',
                    'user_addresses.address',
                    'user_addresses.number',
                    'user_addresses.complement',
                    'user_addresses.district',
                    'user_addresses.city',
                    'user_addresses.state',
                    'user_addresses.zip_code')
                ->where('orders.id','LIKE',"%{$search}%")
                ->orWhere('orders.user_id','LIKE',"%{$search}%")
                ->orWhere('users.first_name','LIKE',"%{$search}%")
                ->orWhere('users.email','LIKE',"%{$search}%")
                ->orWhere('users.document1','LIKE',"%{$search}%")
                ->orWhere('users.phone','LIKE',"%{$search}%")
                ->orWhere('users.cell','LIKE',"%{$search}%")
                ->orWhere('users.last_name','LIKE',"%{$search}%")
                ->orWhere('user_addresses.city','LIKE',"%{$search}%")
                ->whereNull('orders.deleted_at')
                ->count();

        }


        $data  = array();
        $configFreight = $this->configFreight->setId(1);
        if(!empty($query))
        {
            foreach ($query as $val){

                if ($val->profile_id == 3){
                    $name = $val->first_name.'<br>'.$val->last_name.'<br>Código: '.$val->user_id;
                    $document_html  = "<p>CNPJ: <strong> {$val->document1} </strong></p>";
                    $document_html .= "<p>Inscrição Estadual: <strong> {$val->document2} </strong></p>";
                    $name_html  = "<p>Nome Fantasia: <strong> {$val->first_name} </strong></p>";
                    $name_html .= "<p>Razão Social: <strong> {$val->last_name} </strong></p>";
                } else {
                    $name = $val->first_name.' '.$val->last_name.'<br>Código: '.$val->user_id;
                    $name_html  = "<p>Nome: <strong> {$val->first_name} {$val->last_name} </strong></p>";
                    $document_html  = "<p>CPF: <strong> {$val->document1} </strong></p>";
                    $document_html .= "<p>RG: <strong> {$val->document2} </strong></p>";
                }

                $strA  = $val->admin;
                $strA  = explode(" ", $strA);
                $admN = $strA[0];
                ($val->admin != null ? $admin = '<p><strong>'.$admN.'</strong></p>' : $admin = '');



                $state_html = $val->state.'<br><button class="button disabled anthracite-gradient compact">'.$val->qty.'</button>';

                $nData['id']                       = $val->id;
                $nData['state']                    = $state_html;
                $nData['name']                     = $name;
                $nData['profile']                  = $val->profile;
                $nData['config_form_payment_id']   = $val->payment;
                $nData['config_status_payment_id'] = $val->status;
                $nData['subtotal']                 = setReal($val->subtotal);
                $nData['created_at']               = date('d/m/Y H:i:s', strtotime($val->created_at));
                $nData['price_cash']               = $val->price_cash;
                $nData['percent']                  = $val->percent;
                $nData['discount']                 = $val->discount;
                $nData['freight']                  = $val->freight;
                $nData['tax']                      = $val->tax;
                $nData['admin']                    = $admin;
                $nData['ip']                       = $val->ip;

                $nData['profile_html']             = "<h4 class=\"blue underline\">Perfil: {$val->profile} </h4>";
                $nData['name_html']                = $name_html;
                $nData['document_html']            = $document_html;
                $nData['email']                    = $val->email;
                $nData['cell']                     = $val->cell;
                $nData['phone']                    = $val->phone;

                $nData['user_id']                  = $val->user_id;
                $nData['admin']                    = $val->admin;
                $nData['status']                   = $val->status;
                $nData['payment']                  = $val->payment;
                $nData['price_cash']               = setReal($val->price_cash);
                $nData['price_card']               = setReal($val->payment);
                $nData['freight']                  = setReal($val->freight);
                $nData['discount']                 = setReal($val->discount);
                $nData['tax']                      = setReal($val->tax);
                $nData['number']                   = $val->id;


                if ($val->delivery == 1) {
                    $nData['delivery']             = '<h4 class="blue underline">Endereço de Entrega</h4>';
                    $nData['address']              = $val->address;
                    $nData['number']               = $val->number;
                    $nData['complement']           = $val->complement;
                    $nData['district']             = $val->district;
                    $nData['city']                 = $val->city;
                    $nData['state2']               = $val->state;
                    $nData['zip_code']             = $val->district;
                } else {
                    $nData['delivery']             = '<h4 class="red underline">Não há endereço de entrega</h4>';
                }

                $nData['notes']  =  $this->interNotes->countNotes($val->id);
                $data[] = $nData;


            }
        }

        $out = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return $out;
    }


    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->get();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->withTrashed()->find($id);
    }


    /**
     * @param $user_id
     * @return mixed
     */
    public function getOrder($user_id)
    {
        return $this->model->where('user_id', $user_id)->orderBy('id','desc')->get();
    }

    /**
     * @param $input
     * @param $status
     * @param $form
     * @return bool
     */
    public function create($input,$status,$form)
    {
        $data = $this->model->create($input);
        if ($data) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                    ' Adicionou o Pedido:'.$data->id.
                    ', Status:'.$status.
                    ', Forma de Pagamento:'.$form.
                    ', IP:'.$data->ip)
            );

            return $data;
        }

        return false;

    }

    /**
     * @param $input
     * @param $id
     * @return bool
     */
    public function update($input, $id)
    {
        $data = $this->setId($id);

        $update = $data->update($input);
        if ($update) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                    ' Alterou o Pedido:'.$data->id.
                    ', Vendedor:'.$data->user->admin.
                    ', Cliente:'.$data->user_id.
                    ', Pgamento:'.$data->configFormPayment->label.
                    ', Status:'.$data->configStatusPayment->label.
                    ', %:'.$data->percent.
                    ', À Vista:'.setReal($data->price_cash).
                    ', Cartão:'.setReal($data->price_card).
                    ', Desconto:'.setReal($data->discount).
                    ', Frete:'.setReal($data->freight).
                    ', Taxa:'.setReal($data->tax).
                    ', Peso:'.$data->weight)
            );
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $data   = $this->model->find($id);
        $delete = $data->delete();
        if ($delete) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                    ' Excluiu o Pedido:'.$data->id.
                    ', Vendedor:'.$data->user->admin.
                    ', Cliente:'.$data->user_id.
                    ', Pgamento:'.$data->configFormPayment->label.
                    ', Status:'.$data->configStatusPayment->label.
                    ', %:'.$data->percent.
                    ', À Vista:'.setReal($data->price_cash).
                    ', Cartão:'.setReal($data->price_card).
                    ', Desconto:'.setReal($data->discount).
                    ', Frete:'.setReal($data->freight).
                    ', Taxa:'.setReal($data->tax).
                    ', Peso:'.$data->weight)
            );
            return true;
        }

        return false;
    }

    /**
     * @param $request
     * @return array
     */
    public function getExcluded($request)
    {
        $columns = array(
            0   => 'id',
            1   => 'state',
            2   => 'user_id',
            3   => 'profile',
            4   => 'config_form_payment_id',
            5   => 'price_card',
            6   => 'config_status_payment_id',
            7   => 'created_at',
            8   => 'price_cash',
            9   => 'discount',
            10  => 'freight',
            11  => 'tax',
            12  => 'weight',
            13  => 'width',
            14  => 'height',
            15  => 'length',
            16  => 'admin',
            17  => 'ip'
        );

        $totalData = $this->model->where('orders.deleted_at', '!=', null)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $query = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('config_form_payments', 'config_form_payments.id', '=', 'orders.config_form_payment_id')
                ->join('config_status_payments', 'config_status_payments.id', '=', 'orders.config_status_payment_id')
                ->join('user_addresses', 'user_addresses.user_id', '=', 'orders.user_id')
                ->join('config_profile_clients', 'config_profile_clients.id', '=', 'users.profile_id')
                ->select(
                    'orders.*',
                    'config_form_payments.label as payment',
                    'config_status_payments.label as status',
                    'users.first_name',
                    'users.profile_id',
                    'users.last_name',
                    'users.document1',
                    'users.document2',
                    'users.cell',
                    'users.phone',
                    'users.email',
                    'users.admin',
                    'config_profile_clients.name as profile',
                    'user_addresses.delivery',
                    'user_addresses.address',
                    'user_addresses.number',
                    'user_addresses.complement',
                    'user_addresses.district',
                    'user_addresses.city',
                    'user_addresses.state',
                    'user_addresses.zip_code')
                ->where('orders.deleted_at', '!=', null)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();


        } else {

            $search = $request->input('search.value');

            $query = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('config_form_payments', 'config_form_payments.id', '=', 'orders.config_form_payment_id')
                ->join('config_status_payments', 'config_status_payments.id', '=', 'orders.config_status_payment_id')
                ->join('user_addresses', 'user_addresses.user_id', '=', 'orders.user_id')
                ->join('config_profile_clients', 'config_profile_clients.id', '=', 'users.profile_id')
                ->select(
                    'orders.*',
                    'config_form_payments.label as payment',
                    'config_status_payments.label as status',
                    'users.first_name',
                    'users.profile_id',
                    'users.last_name',
                    'users.document1',
                    'users.document2',
                    'users.cell',
                    'users.phone',
                    'users.email',
                    'users.admin',
                    'config_profile_clients.name as profile',
                    'user_addresses.delivery',
                    'user_addresses.address',
                    'user_addresses.number',
                    'user_addresses.complement',
                    'user_addresses.district',
                    'user_addresses.city',
                    'user_addresses.state',
                    'user_addresses.zip_code')
                ->where('orders.deleted_at', '!=', null)
                ->orWhere('orders.id','LIKE',"%{$search}%")
                ->orWhere('orders.user_id','LIKE',"%{$search}%")
                ->orWhere('users.first_name','LIKE',"%{$search}%")
                ->orWhere('users.last_name','LIKE',"%{$search}%")
                ->orWhere('users.email','LIKE',"%{$search}%")
                ->orWhere('users.document1','LIKE',"%{$search}%")
                ->orWhere('users.phone','LIKE',"%{$search}%")
                ->orWhere('users.cell','LIKE',"%{$search}%")
                ->orWhere('user_addresses.city','LIKE',"%{$search}%")
                ->whereNull('orders.deleted_at')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('config_form_payments', 'config_form_payments.id', '=', 'orders.config_form_payment_id')
                ->join('config_status_payments', 'config_status_payments.id', '=', 'orders.config_status_payment_id')
                ->join('user_addresses', 'user_addresses.user_id', '=', 'orders.user_id')
                ->join('config_profile_clients', 'config_profile_clients.id', '=', 'users.profile_id')
                ->select(
                    'orders.*',
                    'config_form_payments.label as payment',
                    'config_status_payments.label as status',
                    'users.first_name',
                    'users.profile_id',
                    'users.last_name',
                    'users.document1',
                    'users.document2',
                    'users.cell',
                    'users.phone',
                    'users.email',
                    'users.admin',
                    'config_profile_clients.name as profile',
                    'user_addresses.delivery',
                    'user_addresses.address',
                    'user_addresses.number',
                    'user_addresses.complement',
                    'user_addresses.district',
                    'user_addresses.city',
                    'user_addresses.state',
                    'user_addresses.zip_code')
                ->where('orders.deleted_at', '!=', null)
                ->orWhere('orders.id','LIKE',"%{$search}%")
                ->orWhere('orders.user_id','LIKE',"%{$search}%")
                ->orWhere('users.first_name','LIKE',"%{$search}%")
                ->orWhere('users.email','LIKE',"%{$search}%")
                ->orWhere('users.document1','LIKE',"%{$search}%")
                ->orWhere('users.phone','LIKE',"%{$search}%")
                ->orWhere('users.cell','LIKE',"%{$search}%")
                ->orWhere('users.last_name','LIKE',"%{$search}%")
                ->orWhere('user_addresses.city','LIKE',"%{$search}%")
                ->whereNull('orders.deleted_at')
                ->count();

        }


        $data  = array();
        $configFreight = $this->configFreight->setId(1);
        if(!empty($query))
        {
            foreach ($query as $val){

                if ($val->profile_id == 3){
                    $name = $val->first_name.'<br>'.$val->last_name.'<br>Código: '.$val->user_id;
                    $document_html  = "<p>CNPJ: <strong> {$val->document1} </strong></p>";
                    $document_html .= "<p>Inscrição Estadual: <strong> {$val->document2} </strong></p>";
                    $name_html  = "<p>Nome Fantasia: <strong> {$val->first_name} </strong></p>";
                    $name_html .= "<p>Razão Social: <strong> {$val->last_name} </strong></p>";
                } else {
                    $name = $val->first_name.' '.$val->last_name.'<br>Código: '.$val->user_id;
                    $name_html  = "<p>Nome: <strong> {$val->first_name} {$val->last_name} </strong></p>";
                    $document_html  = "<p>CPF: <strong> {$val->document1} </strong></p>";
                    $document_html .= "<p>RG: <strong> {$val->document2} </strong></p>";
                }

                $state_html = $val->state.'<br><button class="button disabled anthracite-gradient compact">'.$val->qty.'</button>';


                $nData['id']                       = $val->id;
                $nData['state']                    = $state_html;
                $nData['user_id']                  = $name;
                $nData['profile']                  = $val->profile;
                $nData['config_form_payment_id']   = $val->payment;
                $nData['price_card']               = $val->price_card;
                $nData['config_status_payment_id'] = $val->status;
                $nData['created_at']               = date('d/m/Y H:i:s', strtotime($val->created_at));
                $nData['price_cash']               = $val->price_cash;
                $nData['percent']                  = $val->percent;
                $nData['discount']                 = $val->discount;
                $nData['freight']                  = $val->freight;
                $nData['tax']                      = $val->tax;
                $nData['weight']                   = $val->weight;
                $nData['width']                    = $val->width;
                $nData['height']                   = $val->height;
                $nData['length']                   = $val->length;
                $nData['admin']                    = $val->admin;
                $nData['ip']                       = $val->ip;

                $nData['profile_html']             = "<h4 class=\"blue underline\">Perfil: {$val->profile} </h4>";
                $nData['name_html']                = $name_html;
                $nData['document_html']            = $document_html;
                $nData['email']                    = $val->email;
                $nData['cell']                     = $val->cell;
                $nData['phone']                    = $val->phone;

                $nData['admin']                    = $val->admin;
                $nData['status']                   = $val->status;
                $nData['payment']                  = $val->payment;
                $nData['price_cash']               = setReal($val->price_cash);
                $nData['price_card']               = setReal($val->payment);
                $nData['freight']                  = setReal($val->freight);
                $nData['discount']                 = setReal($val->discount);
                $nData['tax']                      = setReal($val->tax);

                ($configFreight->weight == 1 ? $nData['weight'] = "<p>Peso: <strong> {$val->weight} </strong></p>" : $nData['weight'] ='');
                ($configFreight->width == 1 ? $nData['width'] = "<p>Largura: <strong> {$val->width} </strong></p>" : $nData['width'] ='');
                ($configFreight->height == 1 ? $nData['height'] = "<p>Altura: <strong> {$val->height} </strong></p>" : $nData['height'] ='');
                ($configFreight->length == 1 ? $nData['length'] = "<p>Comprimento: <strong> {$val->length} </strong></p>" : $nData['length'] ='');

                if ($val->delivery == 1) {
                    $nData['delivery']             = '<h4 class="blue underline">Endereço de Entrega</h4>';
                    $nData['address']              = $val->address;
                    $nData['number']               = $val->number;
                    $nData['complement']           = $val->complement;
                    $nData['district']             = $val->district;
                    $nData['city']                 = $val->city;
                    $nData['state2']               = $val->state;
                    $nData['zip_code']             = $val->district;
                } else {
                    $nData['delivery']             = '<h4 class="red underline">Não há endereço de entrega</h4>';
                }

                $nData['notes']  =  $this->interNotes->countNotes($val->id);
                $data[] = $nData;

            }
        }

        $out = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return $out;
    }


    /**
     * Restore
     * @param $id
     * @return bool
     */
    public function reactivate($id)
    {
        $data = $this->setId($id);
        if ( $data->restore() ){
            generateAccessesTxt(
                date('H:i:s').utf8_decode(' Reativou o pedido excluido: '.$data->id)
            );
            return true;
        }

        return false;
    }

}