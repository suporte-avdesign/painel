<p class="button-height inline-label">
    <label for="freight" class="label">Frete</label>
    <span class="button-group">
        <label for="freight_1" class="button green-active">
            <input type="radio" onclick="setFreight(1)" name="prod[freight]" id="freight_1" value="1"checked>
            Ativo
        </label>
        <label for="freight_2" class="button red-active" >
            <input type="radio" onclick="setFreight(0)" name="prod[freight]" id="freight_2" value="0">
            Inativo
        </label>
    </span>
</p>

<span id="fields_freight" style="display:block">
    @if($freight->weight == 1)
        <p class="button-height inline-small-label">
            <label for="weight" class="label">Peso<span class="red">*</span></label>
            <input type="text" name="prod[weight]" id="weight" value="" class="input" autocomplete="off" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
    @if($freight->width == 1)
        <p class="button-height inline-small-label">
            <label for="width" class="label">Largura<span class="red">*</span></label>
            <input type="text" name="prod[width]" id="width" value="}" autocomplete="off" class="input" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
    @if($freight->height == 1)
        <p class="button-height inline-small-label">
            <label for="height" class="label">Altura<span class="red">*</span></label>
            <input type="text" name="prod[height]" id="height" value="" autocomplete="off" class="input" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
    @if($freight->length == 1)
        <p class="button-height inline-small-label">
            <label for="length" class="label">Comprimento<span class="red">*</span></label>
            <input type="text" name="prod[length]" id="length" value="" autocomplete="off" class="input" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
        </p>
    @endif
</span>
