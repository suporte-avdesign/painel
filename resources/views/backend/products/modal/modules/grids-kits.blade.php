@if(isset($data))

    <fieldset class="fieldset">
        <legend class="legend">Grades </legend>
        @if($configProduct->stock == 1)
            <div class="align-right compact">
                <a href="javascript:addGrid('{{$data->id}}', '1', '{{$kit}}');" class="button icon-plus blue-gradient" title="Adicionar"></a>
            </div>
        @else
            <div class="align-right compact">
                <a href="javascript:addGrid('{{$data->id}}', '0', '{{$kit}}');" class="button icon-plus blue-gradient" title="Adicionar"></a>
            </div>
        @endif      

        <ul id="grids-{{$data->id}}" class="list">
            @if($configProduct->stock == 1)
                @php
                    $sum_low   = 0;
                    $sum_entry = 0;
                    $sum_stock = 0;
                @endphp
            @endif
            @foreach($grids as $val)
                @php
                    $keys[] = explode(",", $val->grid);
                @endphp
                @if($configProduct->stock == 1)
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
                        <div class="button-group absolute-right compact show-on-parent-hover">
                            <a class="button icon-trash with-tooltip red-gradient confirm" title="Excluir"></a>
                        </div>
                    </li>
                @endforeach
            @endforeach
            @if($configProduct->stock == 1)
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
    </fieldset>



@else
    <p class="block-label button-height">
        <label for="grid_colors" class="label">Grades<span class="red"> *</span></label>
        <select id="grid_colors" name="grid" class="select grid_colors">
            <option value="">Selecione Uma</option>
            <option value="brand">Fabricante</option>
            <option value="section">Seção</option>
            <option value="category">Categoria</option>
        </select>
        @if(isset($product))
            <input id="bra_id" type="hidden" value="{{$product->brand_id}}">
            <input id="sec_id" type="hidden" value="{{$product->section_id}}">
            <input id="cat_id" type="hidden" value="{{$product->category_id}}">
            <input id="sto_id" name="prod[stock]" type="hidden" value="{{$product->stock}}">
        @endif
    </p>
@endif                    

<div align="center">
    <span id="loader-grids" class="loader working" style="display:none;"></span>
</div>  
<div id="box-grids-colors"></div>

@if(isset($product))
<script type="text/javascript">
    $( ".grid_colors" ).change(function() {
        var mod,
        opc = $(this).val(),
        stock = $("#sto_id").val();
        if (opc == 'brand') {
            mod  = $("#bra_id" ).val();
        } else if (opc == 'section') {
            mod = $("#sec_id").val();
        } else if (opc == 'category') {
            mod = $("#cat_id").val();
        }

        $("#loader-grids").show();
        $( "#box-grids-colors").html("");

      
        $.get( base+"/produto/{{$idpro}}/grids/"+opc+"/"+mod+"/"+stock, function( data ) {
            $("#loader-grids").hide();
            $( "#box-grids-colors").html( data );
        });
    });
</script>
@else
<script type="text/javascript">
    $( ".grid_colors" ).change(function() {
        var mod,msg,
        opc = $(this).val(),
        stock = $( 'input[name="stock"]' ).val(),
        idpro = $( 'input[name="img[product_id]"]' ).val();
        if (opc == 'brand') {
            mod  = $( "#brand_id option:selected" ).val();
        } else if (opc == 'section') {
            mod = $( 'input[name="prod[section_id]"]' ).val();
        } else if (opc == 'category') {
            mod = $( 'input[name="prod[category_id]"]' ).val();
        }
        if (mod) {
            $("#loader-grids").show();
            $("#box-grids-colors").html("");
          
            $.get( base+"/painel/produto/"+idpro+"/grids/"+opc+"/"+mod+"/"+stock, function( data ) {
                $("#loader-grids").hide();
                $("#box-grids-colors").html( data );
            });
        } else {
            (opc = 'brand' ? msg = 'Selecione o Fabricante' : msg = 'Selecione a '+opc);
            $("#box-grids-colors").html( '<p class="message red-gradient">'+msg+'</p>');
        }

    });
</script>
<script>
$('.list .button-group a:last-child').data('confirm-options', {

    onShow: function()
    {
        // Remove auto-hide class
        $(this).parent().removeClass('show-on-parent-hover');
    },

    onConfirm: function()
    {
        // Remove element
        $(this).closest('li').fadeAndRemove();

        // Prevent default link behavior
        return false;
    },

    onRemove: function()
    {
        // Restore auto-hide class
        $(this).parent().addClass('show-on-parent-hover');
    }

});
</script>
@endif