<ul id="grids-{{$data->id}}" class="list">
    @php
        $col       = 'red';
        $sum_output   = 0;
        $sum_input = 0;
        $sum_stock = 0;
    @endphp
    @foreach($grids as $val)
        @php
            $total  = $val->stock;
            $keys[] = explode(",", $val->grid);
        @endphp
        @if($data->stock == 1)
            @php
                $sum_input += $val->input;
                $sum_output   += $val->output;
            @endphp
        @endif
    @endforeach
    @foreach($keys as $values)
        @foreach($values as $key => $grid)
            @php
                $exp = explode("/", $grid);
                $qty = $exp[0];
                $grd = $exp[1];
            @endphp
            @if($stock == 1)
                <li>
                    <span class="input">
                        <label for="grid-{{$key}}" class="button blue-gradient">{{$grid}}</label>
                        <input type="text" name="grids[qty]" id="qty-{{$key}}"  autocomplete="off" value="{{$qty}}" maxlength="4" class="input-unstyled input-sep" style="width: 50px;">
                        <input type="text" name="grids[{{$key}}][grid]" id="grid-{{$key}}" autocomplete="off" class="input-unstyled"  value="{{$grd}}" style="width: 50px;">
                    </span>
                    <div class="button-group absolute-right compact">
                        <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                    </div>
                </li>
            @else
                <li>
                    <span class="input">
                        <label for="grid-{{$key}}" class="button blue-gradient">{{$grid}}</label>
                        <input type="text" name="grids[qty]" id="qty-{{$key}}"  autocomplete="off" value="{{$qty}}" maxlength="4" class="input-unstyled input-sep" style="width: 50px;">
                        <input type="text" name="grids[{{$key}}][grid]" id="grid-{{$key}}" autocomplete="off" class="input-unstyled"  value="{{$grd}}" style="width: 50px;">
                    </span>
                    <div class="button-group absolute-right compact">
                        <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                    </div>
                </li>
            @endif
        @endforeach
    @endforeach
    @if($stock == 1)
        @php
            if($kit == 1) {
                $sum_stock = $total;
            } else {
                $sum_stock = $sum_input - $sum_output;
            }
            ($sum_stock >= 1 ? $col = 'blue' : $col = 'red');
        @endphp
        <li>
            <span class="input">
                <label for="pseudo-input-2" class="button blue-gradient">
                    <span class="small-margin-right">Estoque</span>
                </label>
                <input type="text" name="grids[input]" id="input-{{$data->id}}" class="input-unstyled" placeholder="Entrada" value="" maxlength="4" style="width: 50px;">
                <label for="pseudo-input-2" class="button {{$col}}-gradient">
                    <span class="small-margin-right">{{$sum_stock}}</span>
                </label>
            </span>                
        </li>              
    @endif
</ul>


