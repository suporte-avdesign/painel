<p class="button-height inline-label">
    <label for="freight" class="label">Frete</label>
    <span class="button-group">
        @if(isset($data))
            <label for="freight_1" class="button green-active">
                <input type="radio" onclick="setFreight(1)" name="prod[freight]" id="freight_1" value="1"@if($data->freight == 1) checked @endif>
                Ativo
            </label>
            <label for="freight_2" class="button red-active" >
                <input type="radio" onclick="setFreight(0)" name="prod[freight]" id="freight_2" value="0"@if($data->freight == 0) checked @endif>
                Inativo
            </label>
        @else
            <label for="freight_1" class="button green-active">
                <input type="radio" onclick="setFreight(1)" name="prod[freight]" id="freight_1" value="1"checked>
                Ativo
            </label>
            <label for="freight_2" class="button red-active" >
                <input type="radio" onclick="setFreight(0)" name="prod[freight]" id="freight_2" value="0">
                Inativo
            </label>
        @endif
    </span>
</p>

@if(isset($data))
    <span id="fields_freight" style="display:@if($data->freight == 1 ) block @else none @endif">
@else
    <span id="fields_freight" style="display:block">
@endif

    @if($freight->weight == 1)
        <p class="button-height inline-small-label">
            <label for="weight" class="label">Peso<span class="red">*</span></label>
            <input type="text" name="prod[weight]" id="weight" value="{{$data->weight or old('weight')}}" class="input" autocomplete="off" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
    @if($freight->width == 1)
        <p class="button-height inline-small-label">
            <label for="width" class="label">Largura<span class="red">*</span></label>
            <input type="text" name="prod[width]" id="width" value="{{$data->width or old('width')}}" autocomplete="off" class="input" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
    @if($freight->height == 1)
        <p class="button-height inline-small-label">
            <label for="height" class="label">Altura<span class="red">*</span></label>
            <input type="text" name="prod[height]" id="height" value="{{$data->height or old('height')}}" autocomplete="off" class="input" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
    @if($freight->length == 1)
        <p class="button-height inline-small-label">
            <label for="length" class="label">Comprimento<span class="red">*</span></label>
            <input type="text" name="prod[length]" id="length" value="{{$data->length or old('length')}}" autocomplete="off" class="input" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
</span>
