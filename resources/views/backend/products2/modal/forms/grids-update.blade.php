<ul id="grids-{{$data->id}}" class="list">
    @if($stock == 1)
        <li><label for="grid_colors" class="label">Grade | Entada | Saida </label></li>
    @else
        <li><label for="grid_colors" class="label">Grade</label></li>
    @endif
    @foreach($grids as $grid)
        @if($stock == 1)
            @php                 
                ($grid->stock >= 1 ? $col = 'blue' : $col = 'red');
            @endphp
            <li>
                <span class="input">
                    <input type="text" name="grids[{{$grid->id}}][grid]" id="grid_{{$grid->id}}" class="input-unstyled input-sep" value="{{$grid->grid}}" maxlength="4" style="width: 30px;">
                    <input type="text" name="grids[{{$grid->id}}][entry]" id="entry_{{$grid->id}}" class="input-unstyled input-sep" value="{{$grid->entry}}" maxlength="4"  style="width: 30px;">
                    <input type="text" name="grids[{{$grid->id}}][low]" id="exit_{{$grid->id}}" class="input-unstyled input-sep" value="{{$grid->low}}" maxlength="4"  style="width: 30px;">
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