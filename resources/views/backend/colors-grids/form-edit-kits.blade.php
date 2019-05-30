<ul id="grids-{{$data->id}}" class="list">
    @php
        $col       = 'red';
        $sum_low   = 0;
        $sum_entry = 0;
        $sum_stock = 0;
    @endphp
    @foreach($grids as $val)
        @php
            $keys[] = explode(",", $val->grid);
        @endphp
        @if($data->stock == 1)
            @php
                ($val->stock >= 1 ? $col = 'blue' : $col = 'red');
                $sum_entry += $val->entry;
                $sum_low   += $val->low;                   
            @endphp
        @endif
    @endforeach
    @foreach($keys as $values)
        @foreach($values as $key => $grid)
            <li>
                <span class="input">
                    <label for="grid-{{$key}}" class="button blue-gradient">{{$grid}}</label>
                    <input type="text" name="grids[{{$key}}][grid]" id="grid-{{$key}}" class="input-unstyled" value="{{$grid}}" style="width: 100px;">
                </span>
                <div class="button-group absolute-right compact">
                    <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                </div>
            </li>
        @endforeach
    @endforeach
    @if($stock == 1)
        @php
            $sum_stock = $sum_entry - $sum_low;


        @endphp
        <li><label for="grid_colors" class="label"> Entada | Saida | Estoque</label></li>
        <li>
            <span class="input">
                <input type="text" name="grids[entry]" id="entry" class="input-unstyled input-sep" placeholder="Entrada" value="{{$sum_entry}}" maxlength="4" style="width: 50px;">
                <input type="text" name="grids[low]" id="low" class="input-unstyled" placeholder="Saida" value="{{$sum_low}}" style="width: 50px;">
                <label for="pseudo-input-2" class="button {{$col}}-gradient">
                    <span class="small-margin-right">{{$sum_stock}}</span>
                </label>
            </span>                
        </li>              
    @endif
</ul>
