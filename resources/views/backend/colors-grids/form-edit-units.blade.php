<ul id="grids-{{$data->id}}" class="list">
    @foreach($grids as $grid)
        @if($stock == 1)
            @php
                ($grid->stock >= 1 ? $col = 'blue' : $col = 'red');
            @endphp
            <li>
                <span class="input">
                    <label for="low" class="button compact {{$col}}-gradient">{{$grid->grid}}</label>
                    <input type="hidden" name="grids[{{$grid->id}}][grid]" id="grid_{{$grid->id}}" value="{{$grid->grid}}">
                    <input type="text" name="grids[{{$grid->id}}][entry]"  id="entry_{{$grid->id}}" value="" autocomplete="off" placeholder="Entrada" maxlength="4" class="input-unstyled" style="width: 50px;">
                    <label for="low" class="button compact {{$col}}-gradient">{{$grid->stock}}</label>
                </span>
                <div class="button-group absolute-right compact">
                    <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                </div>
            </li>
        @else
            <li>
                <span class="input">
                    <input type="text" name="grids[{{$grid->id}}][grid]" id="grid_{{$grid->id}}" class="input-unstyled input-sep" value="{{$grid->grid}}" maxlength="4" style="width: 30px;">
                </span>
                <div class="button-group absolute-right compact">
                    <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                </div>
            </li>
        @endif
    @endforeach
</ul>