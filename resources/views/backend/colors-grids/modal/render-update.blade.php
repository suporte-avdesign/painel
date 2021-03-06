@if($product->stock == 1)
    @php
        $text_qty = constLang('qty');
        ($grid->stock >= 1 ? $col = 'blue' : $col = 'red');
    @endphp
    <li id="list-grid-{{$grid->id}}">
        <span class="input">
            <label for="low" class="button compact blue-gradient">{{$grid->grid}}</label>
            <label for="low" class="button compact {{$col}}-gradient">{{$grid->stock}}</label>
        </span>
        @if($product->qty_min == 1 || $product->qty_max == 1)
            <span class="input">
                @if($product->qty_min == 1)
                    <label for="low" class="button compact silver-gradient">{{$grid->qty_min}}</label>
                @endif
                @if($product->qty_max == 1)
                    <label for="low" class="button compact silver-gradient">{{$grid->qty_max}}</label>
                @endif
            </span>
        @endif
        <div class="button-group absolute-right compact">
            <a href="javascript:deleleGridProduct('{{$grid->id}}', '{{route('grid-color.destroy', $grid->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip red-gradient confirm" title="{{constLang('delete')}}"></a>
            <a href="javascript:void(0);" onclick="abreModal('{{constLang('edit')}} {{constLang('grid')}}:{{$grid->grid}}', '{{route('grid-color.show', $grid->id)}}', 'grids', 1, 'true', 230, 250);" class="button icon-pencil with-tooltip blue-gradient" title="{{constLang('edit')}}"></a>
        </div>
    </li>
@else
    <li>
        <span class="input">
            <label for="low" class="button compact {{$col}}-gradient">{{$grid->grid}}</label>
        </span>
        <div class="button-group absolute-right compact">
            <a href="javascript:deleleGridProduct('{{$grid->id}}', '{{route('grid-color.destroy', $grid->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip red-gradient confirm" title="{{constLang('delete')}}"></a>
        </div>
    </li>
@endif