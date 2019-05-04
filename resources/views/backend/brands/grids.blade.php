<div class="block-title silver-gradient">
    <h3>
        <span class="icon icon-thumbs" aria-hidden="true"></span>
        <strong> {{$title}} </strong>
    </h3>
</div>
<div class="silver-gradient">
    <div class="with-padding">
        <h2 class="relative thin">
            Importante
            <span class="info-spot">
                <span class="icon-info-round"></span>
                <span class="info-bubble">
                    Para criar novas grids, clique em adicionar digite o nome e a grade separados por vírgula  Ex:<br> Unidade:<br>(33, 34, 35)<br>Kit:<br>(2/33, 1/34, 2/35)
                </span>
            </span>
            @can('brand-grids-create')
                <span class="button-group absolute-right">
                    <button onclick="abreModal('Adicionar Grade', '{{route('grids-brand.create', $id)}}', 'brand-grids', 2, 'true', 400, 250);" title="Adicionar Grade" class="button icon-plus-round blue-gradient">Adicionar</button>
                </span>
            @endcan
        </h2>
            
        <ul id="grids" class="list spaced">
            @forelse($data as $val)
                <li id="grid_{{$val->id}}">
                    <h3 class="thin underline">
                        @if($val->type == 'kit')
                            <span class="icon-thumbs" title="Kit"></span>&nbsp;
                        @endif
                        @if($val->type == 'unit')
                            <span class="icon-stop" title="Und"></span>&nbsp;
                        @endif
                        {{$val->name}}
                    </h3>

                    <a href="javascript:void(0)" class="list-link"><strong> {{$val->label}} </strong></a>
                    <div class="button-group absolute-right compact">
                        @can('brand-grids-update')
                            <button id="btn-edit" onclick="abreModal('Alterar Grade: {{ $val->name }}', '{{route('grids-brand.edit', ['id' => $id, 'grid' => $val->id])}}', 'brand-grids', 2, 'true', 400, 250);" class="button icon-pencil blue-gradient">Editar</button>
                        @endcan
                        @can('brand-grids-delete')
                            <button id="btn-delete" onclick="deleteGrid('{{ $val->id }}', '{{ $val->name }}', '{{route('grids-brand.destroy', ['id' => $id, 'grid' => $val->id])}}', '{{ csrf_token() }}');" class="button icon-trash with-tooltip red-gradient" title="Excluir Grade"></button>
                        @endcan
                    </div>
                </li>
            @empty
                <li><h3 class="thin underline">Não existe nenhuma grade cadastrada.</h3></li>
            @endforelse
        </ul>

    </div>
</div>