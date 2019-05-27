<div class="block">
    <div class="with-padding">
        <h4 class="blue underline">Perfil do Produto</h4>
        <ul class="bullet-list">
            <li>Nome: <strong> {{$data->name}} </strong></li>
            <li>Descrição: <strong> {{$data->description}} </strong></li>
            <li>Tags: <strong> {{$data->tags}} </strong></li>
            @if($configProduct->cost == 1)
                <li>Custo: <strong> {{setReal($data->cost)}} </strong></li>
            @endif
            @if($configProduct->stock == 1)
                <li>Estoque: <strong> {{$stock}} </strong></li>
            @endif
            @if($configProduct->kit == 1)
                <li>Kit: <strong>  {{$data->kit_name}}</strong></li>
            @endif
            <li>Unidade Medida: <strong>  {{$data->unit}} {{$data->measure}}</strong></li>

            @foreach($prices as $price)
                @php
                    ($price->profile != 'Normal' ? $price_card_percent = $price->sum_card.round($price->price_cash_percent, 2).'%' : $price_card_percent = '');
                @endphp
                <li><small class="tag">{{$price->profile}}</small> À Vista: {{$price->sum_cash}}{{round($price->price_cash_percent, 2)}}%<strong>&nbsp;&nbsp;{{setReal($price->price_cash)}}</strong>&nbsp;&nbsp; - &nbsp;&nbsp;Parcelado: {{$price_card_percent}}<strong>&nbsp;&nbsp;{{setReal($price->price_card)}}</strong></li>
                @if($data->offer == 1)
                <li><small class="tag green-bg">{{$price->profile}}</small> Oferta à Vista: {{round($price->offer_percent, 2)}}%<strong>&nbsp;&nbsp;{{setReal($price->offer_cash)}}</strong>&nbsp;&nbsp; - &nbsp;&nbsp;Parcelado: <strong>{{setReal($price->offer_card)}}</strong></li>
                @endif               
            @endforeach

            @if($configProduct->freight == 1)
                @if($configFreight->weight == 1)
                    <li>Peso: <strong> {{$data->weight}} Kg</strong></li>
                @endif
                @if($configFreight->height == 1)
                    <li>Altura: <strong> {{$data->height}} cm</strong></li>
                @endif
                @if($configFreight->width == 1)
                    <li>Largura: <strong> {{$data->width}} cm</strong></li>
                @endif
                @if($configFreight->length == 1)
                    <li>Comprimento: <strong> {{$data->length}} cm</strong></li>
                @endif
            @endif
            @if($configProduct->video == 1)
                <li>Video: <strong> {{$data->video}} </strong></li>
            @endif
        </ul>
    </div>
</div>