<div class="block">
    <div class="with-padding">
<div class="columns">
    <div class="six-columns">
        <h4 class="blue underline">Perfil: {{$user->profile->name}}</h4>
        @if ($data->user->profile_id == 3)
            <p>Nome Fantasia: <strong> {{$user->first_name}} </strong></p>
            <p>Razão Social: <strong> {{$user->last_name}} </strong></p>
            <p>CNPJ: <strong> {{$user->document1}} </strong></p>
            <p>Inscrição Estadual: <strong> {{$user->document2}} </strong></p>
        @else
            <p>Nome: <strong> {{$user->first_name}} {{$user->last_name}} </strong></p>
            <p>CPF: <strong> {{$user->document1}} </strong></p>
            <p>RG: <strong> {{$user->document2}} </strong></p>
        @endif
        <p>Email: <strong> {{$user->email}} </strong></p>
        <p>WhatsApp: <strong> {{$user->cell}} </strong></p>
        <p>Telefone: <strong> {{$user->phone}} </strong></p>

        @forelse($adresses as $address)
            @if ($address->delivery == 1)
                <h4 class="blue underline">Endereço de Entrega</h4>
                <p>Endereço: <strong> {{$address->address}}, {{$address->number}}</strong></p>
                <p>Complemento: <strong> {{$address->complement}}</strong></p>
                <p>Bairro: <strong> {{$address->district}}</strong></p>
                <p>Cidade: <strong> {{$address->city}}</strong></p>
                <p>Estado: <strong> {{$address->state}}</strong></p>
                <p>CEP: <strong> {{$address->zip_code}}</strong></p>
                <p>IP: <strong> {{$ip}}</strong></p>
            @else
                <h4 class="red underline">Não há endereço de entrega </h4>
            @endif
        @empty
            <h4 class="red underline">Não há endereço de entrega </h4>
        @endforelse
    </div>
    <div class="six-columns">
        <h4 class="blue underline">Pedido N&deg;: {{$data->id}}</h4>
        <p>Status: <strong> {{$data->configStatusPayment->label}} </strong></p>
        <p>Pagamento: <strong> {{$data->configFormPayment->label}}  </strong></p>
        <p>À Vista: <strong> {{setReal($data->price_cash)}} </strong></p>
        <p>No Cartão: <strong> {{setReal($data->price_card)}} </strong></p>
        <p>Desconto: <strong> {{setReal($data->discount)}} </strong></p>
        <p>Taxa: <strong> {{setReal($data->tax)}} </strong></p>
        <h4 class="blue underline">Dados do Frete</h4>
        <p>Valor: <strong> {{setReal($data->freight)}} </strong></p>
        @if($configFreight->weight == 1)
            <p>Peso: <strong> {{$data->weight}} </strong></p>
        @endif
        @if($configFreight->width == 1)
            <p>Largura: <strong> {{$data->width}} </strong></p>
        @endif
        @if($configFreight->height == 1)
            <p>Altura: <strong> {{$data->height}} </strong></p>
        @endif
        @if($configFreight->lenght == 1)
            <p>Comprimento: <strong> {{$data->length}} </strong></p>
        @endif
    </div>
</div>
</div>
</div>
