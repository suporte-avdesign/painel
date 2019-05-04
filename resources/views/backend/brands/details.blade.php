<div class="block">
    <div class="with-padding">
        <h4 class="blue underline">Perfil do Fabricante</h4>
        <ul class="bullet-list">
            <li>Nome: <strong> {{$data->name}} </strong></li>
            <li>Visitas: <strong> {{$data->visits}} </strong></li>
            <li>Descrição: <strong> {{$data->description}} </strong></li>
            <li>Tags: <strong> {{$data->tags}} </strong></li>
            <li>Status Logo:  {{$data->status_logo}}</li>
            <li>Status Banner:  {{$data->status_banner}}</li>
            @if($configModel->info == 1)
                <li>Email: <strong> {{$data->email}} </strong></li>
                <li>Telefone: <strong> {{$data->phone}} </strong></li>
                <li>Endereço: <strong> {{$data->address}}, {{$data->number}}</strong></li>
                <li>Bairro: <strong> {{$data->district}} </strong></li>
                <li>Cidade: <strong> {{$data->city}} - {{$data->state}}</strong></li>
                <li>CEP: <strong>{{$data->zip_code}}</strong> </li>
            @endif
        </ul>
    </div>
</div>

