<ul id="grids-{{$data->id}}" class="list">
    @foreach($grids as $val)
        @php
            $idkit  = $val->id;
            $total  = $val->stock;
            $keys[] = explode(",", $val->grid);
        @endphp
    @endforeach
    @foreach($keys as $values)
        @foreach($values as $key => $grid)
            @php
                $exp = explode("/", $grid);
                $qty = $exp[0];
                $grd = $exp[1];
            @endphp
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
        @endforeach
    @endforeach
</ul>

<input type="hidden" name="grids[id]" value="{{$idkit}}">






