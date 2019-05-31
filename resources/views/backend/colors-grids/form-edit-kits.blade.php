<ul id="grids-{{$data->id}}" class="list">
    @php
        $col       = 'red';
        $sum_low   = 0;
        $sum_entry = 0;
        $sum_stock = 0;
    @endphp
    @foreach($grids as $val)
        @php
            $total  = $val->stock;
            $keys[] = explode(",", $val->grid);
        @endphp
        @if($data->stock == 1)
            @php
                $sum_entry += $val->entry;
                $sum_low   += $val->low;
            @endphp
        @endif
    @endforeach
    @foreach($keys as $values)
        @foreach($values as $key => $grid)
            @if($stock == 1)
                <li>
                    <span class="input">
                        <label for="grid-{{$key}}" class="button blue-gradient">{{$grid}}</label>
                        <input type="text" name="grids[qty]" id="entry-{{$key}}"  autocomplete="off" placeholder="Qtd" value="" maxlength="4" class="input-unstyled input-sep" style="width: 50px;">
                        <input type="text" name="grids[{{$key}}][grid]" id="grid-{{$key}}" autocomplete="off" class="input-unstyled" placeholder="Grade" value="" style="width: 50px;">
                    </span>
                    <div class="button-group absolute-right compact">
                        <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                    </div>
                </li>
            @else

            @endif
        @endforeach
    @endforeach
    @if($stock == 1)
        @php
            if($kit == 1) {
                $sum_stock = $total;
            } else {
                $sum_stock = $sum_entry - $sum_low;
            }
            ($sum_stock >= 1 ? $col = 'blue' : $col = 'red');
        @endphp
        <li>
            <span class="input">
                <label for="pseudo-input-2" class="button blue-gradient">
                    <span class="small-margin-right">Estoque</span>
                </label>
                <input type="text" name="grids[entry]" id="entry-{{$data->id}}" class="input-unstyled" placeholder="Entrada" value="" maxlength="4" style="width: 50px;">
                <label for="pseudo-input-2" class="button {{$col}}-gradient">
                    <span class="small-margin-right">{{$sum_stock}}</span>
                </label>
            </span>                
        </li>              
    @endif
</ul>


