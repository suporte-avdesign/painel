<ul id="grids-{{$data->id}}" class="list">
    @php
        $col       = 'red';
        $sum_output   = 0;
        $sum_input = 0;
        $sum_stock = 0;
    @endphp
    @foreach($grids as $val)
        @php
            $idkit  = $val->id;
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
                        <input type="text" name="qty[{{$key}}]" id="qty-{{$key}}"  autocomplete="off" value="{{$qty}}" maxlength="4" class="input-unstyled input-sep" style="width: 50px;">
                        <input type="text" name="des[{{$key}}]" id="grid-{{$key}}" autocomplete="off" class="input-unstyled"  value="{{$grd}}" style="width: 50px;">
                    </span>
                    <div class="button-group absolute-right compact">
                        <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                    </div>
                </li>
            @else
                <li>
                    <span class="input">
                        <label for="grid-{{$key}}" class="button blue-gradient">{{$grid}}</label>
                        <input type="text" name="grids[{{$key}}][qty]" id="qty-{{$key}}"  autocomplete="off" value="{{$qty}}" maxlength="4" class="input-unstyled input-sep" style="width: 50px;">
                        <input type="text" name="grids[{{$key}}][des]" id="grid-{{$key}}" autocomplete="off" class="input-unstyled"  value="{{$grd}}" style="width: 50px;">
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
        foreach ($grids as $grid) {
            $sum_stock = $grid->stock;
            $qty_min   = $grid->qty_min;
            $qty_max   = $grid->qty_max;
        }
        @endphp
    @endif
</ul>

<input type="hidden" name="grids[id]" value="{{$idkit}}">

@if($stock == 1)
    <p class="button-height block-label margin-top">
        <label for="input" class="label">Entrada no estoque</label>
        <span class="input">
            <label for="pseudo-input-2" class="button blue-gradient">
                <span class="small-margin-right">Entrada</span>
            </label>
            <input type="text" name="grids[input]" id="input-{{$data->id}}" class="input-unstyled" placeholder="Qtd" value="" maxlength="4" onKeyDown="javascript: return maskValor(this,event,4);" style="width: 50px;">
            <label for="pseudo-input-2" class="button blue-gradient">
                <span class="small-margin-right">{{$sum_stock}}</span>
            </label>
        </span>
    </p>
@endif

@if($product->qty_min == 1 || $product->qty_max == 1)
    <p class="button-height block-label">
        <label for="input" class="label">Estoque mínimo / máximo</label>
        <span class="input">
            <label for="qty_stock" class="button blue-gradient">Estoque</label>
            @if($product->qty_min == 1)
                <input type="text" name="grids[qty_min]" value="{{$qty_min}}" placeholder="Mínimo" class="input-unstyled input-sep" autocomplete="off" maxlength="4" onKeyDown="javascript: return maskValor(this,event,4);" style="width: 50px;">
            @endif
            @if($product->qty_max == 1)
                <input type="text" name="grids[qty_max]"  value="{{$qty_max}}" placeholder="Máximo" class="input-unstyled" autocomplete="off" maxlength="4" onKeyDown="javascript: return maskValor(this,event,4);" style="width: 50px;">
            @endif
        </span>
    </p>
@endif



