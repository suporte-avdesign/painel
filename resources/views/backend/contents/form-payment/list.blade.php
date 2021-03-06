@foreach($data as $key => $value)
    <li>
    <li id="content-{{$value->id}}">
        @if($key >= 1)
            <span id="number-{{$value->id}}" class="event-date orange">{{$value->order}}</span>
        @endif
        <h4 id="title-{{$value->id}}">{{$value->title}}</h4>
        <div class="button-group compact">
            @can('contents-site-update')
                <button onclick="abreModal('{{$config['title_edit']}}', '{{route('form-payment.show', $value->id)}}', 'contents', 2, true, 700, 600)" class="button icon-pencil with-tooltip" title="Editar">Editar</button>
                <button id="order-{{$value->id}}" class="button icon-gear with-tooltip tracked" title="Alterar Ordem">Ordem</button>
                <button id="status-{{$value->id}}" onclick="statusContent('{{$value->id}}','{{route('form-payment.status', $value->id)}}','{{csrf_token()}}')" title="Alterar Status" class="button icon-tick with-tooltip @if($value->active == constLang('active_false'))red @endif">{{$value->active}}</button>
            @endcan
            @can('contents-site-delete')
                <button onclick="deleteContent('{{$value->id}}', '{{route('form-payment.destroy', $value->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip red-bg" title="Excluir"></button>
            @endcan
        </div>
        <div class="large-margin-bottom">
            <script>$("#order-{{$value->id}}").menuTooltip("Carregando...",{classes:["with-mid-padding"],ajax:"{{route('form-payment.order', $value->id)}}",onShow:function(e){e.parent().removeClass("show-on-parent-hover")},onRemove:function(e){e.parent().addClass("show-on-parent-hover")}});</script>
        </div>
        <div id="description-{{$value->id}}">
            <p>{!! nl2br($value->description) !!}</p>
        </div>
    </li>
@endforeach
