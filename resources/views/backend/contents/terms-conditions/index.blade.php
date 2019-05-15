<div class="block large-margin-bottom">

    <div class="block-title">
        <h3><span class="icon-page-list"></span> {{$config['title_index']}}</h3>
        @can('contents-site-create')
            <div class="button-group absolute-right compact">
                <button onclick="abreModal('{{$config['title_create']}}', '{{route('terms-conditions.create')}}', 'contents', 2, true, 600, 700)" title="{{$config['title_create']}}" class="button icon-plus-round with-tooltip anthracite-gradient">Adicionar</button>
            </div>
        @endcan
    </div>

    <ul id="list-contents" class="events">
        @foreach($data as $key => $value)
        <li id="content-{{$value->id}}">
            @if($key >= 1)
                <span id="number-{{$value->id}}" class="event-date orange">{{$value->order}}</span>
            @endif
            <h4 id="title-{{$value->id}}">{!! $value->title !!}</h4>
            <div class="button-group compact">
                @can('contents-site-update')
                    <button onclick="abreModal('{{$config['title_edit']}}', '{{route('terms-conditions.show', $value->id)}}', 'contents', 2, true, 700, 600)" class="button icon-pencil with-tooltip" title="Editar">Editar</button>
                    <button id="order-{{$value->id}}" class="button icon-gear with-tooltip tracked" title="Alterar Ordem">Ordem</button>
                    <button id="status-{{$value->id}}" onclick="statusContent('{{$value->id}}','{{route('terms-conditions.status', $value->id)}}','{{csrf_token()}}')" title="Alterar Status" class="button icon-tick with-tooltip @if($value->status == 'Inativo')red @endif">{{$value->status}}</button>
                @endcan
                @can('contents-site-delete')
                    <button onclick="deleteContent('{{$value->id}}', '{{route('terms-conditions.destroy', $value->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip red-bg" title="Excluir"></button>
                @endcan
            </div>
            <div class="large-margin-bottom">
                <script>$("#order-{{$value->id}}").menuTooltip("Carregando...",{classes:["with-mid-padding"],ajax:"{{route('terms-conditions.order', $value->id)}}",onShow:function(e){e.parent().removeClass("show-on-parent-hover")},onRemove:function(e){e.parent().addClass("show-on-parent-hover")}});</script>
            </div>
            <div id="description-{{$value->id}}">
                {!! $value->description !!}
            </div>
        </li>
        @endforeach
    </ul>
</div>
<script src="{{url('assets/backend/scripts/content-site.js')}}?{{time()}}"></script>
