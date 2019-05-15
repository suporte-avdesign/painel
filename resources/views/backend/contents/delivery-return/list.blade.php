@foreach($data as $key => $value)
    <li>
    <li id="content-{{$value->id}}">
        @if($key >= 1)
            <span id="number-{{$value->id}}" class="event-date orange">{{$value->order}}</span>
        @endif
        <h4 id="title-{{$value->id}}">{!! $value->title !!}</h4>
        <div class="button-group compact">
            @can('contents-site-update')
                <button onclick="abreModal('{{$config['title_edit']}}', '{{route('delivery-return.show', $value->id)}}', 'contents', 2, true, 700, 600)" class="button icon-pencil with-tooltip" title="Editar">Editar</button>
                <button id="order-{{$value->id}}" class="button icon-gear with-tooltip tracked" title="Alterar Ordem">Ordem</button>
                <button id="status-{{$value->id}}" onclick="statusContent('{{$value->id}}','{{route('delivery-return.status', $value->id)}}','{{csrf_token()}}')" title="Alterar Status" class="button icon-tick with-tooltip @if($value->status == 'Inativo')red @endif">{{$value->status}}</button>
            @endcan
            @can('contents-site-delete')
                <button onclick="deleteContent('{{$value->id}}', '{{route('delivery-return.destroy', $value->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip red-bg" title="Excluir"></button>
            @endcan
        </div>
        <div class="large-margin-bottom">
            <script>$("#order-{{$value->id}}").menuTooltip("Carregando...",{classes:["with-mid-padding"],ajax:"{{route('delivery-return.order', $value->id)}}",onShow:function(e){e.parent().removeClass("show-on-parent-hover")},onRemove:function(e){e.parent().addClass("show-on-parent-hover")}});</script>
        </div>
        <div id="description-{{$value->id}}">
            {!! $value->description !!}
        </div>
    </li>
@endforeach
