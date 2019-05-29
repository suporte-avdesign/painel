@if(isset($data))
    <fieldset class="fieldset">
        <legend class="legend">Grades</legend>
        <div class="align-right compact">
            <a href="javascript:addGrid('{{$data->id}}','{{$stock}}','{{$kit}}');" class="button icon-plus blue-gradient" title="Adicionar"></a>
        </div>
        <div id="update-grids">            
            @if($kit == 1)       
                @include('backend.colors-grids.form-edit-kits')
            @else
                @include('backend.colors-grids.form-edit')
            @endif
        </div>
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
            <input id="kit_id" name="prod[kit]" type="hidden" value="{{$product->kit}}">
        @endif
    </p>
@endif                    

<div align="center">
    <span id="loader-grids" class="loader working" style="display:none;"></span>
</div>  
<div id="box-grids-colors"></div>

@if(isset($product))
<script type="text/javascript">
    // new color
    $( ".grid_colors" ).change(function() {
        var mod,
            opc   = $(this).val(),
            kit   = $("#kit_id").val();
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

      
        $.get( base+"/product/{{$idpro}}/grids/"+opc+"/"+mod+"/"+stock+"/"+kit, function( data ) {
            $("#loader-grids").hide();
            $( "#box-grids-colors").html( data );
        });
    });
</script>
@else
<script type="text/javascript">
    // new product
    $( ".grid_colors" ).change(function() {
        var mod,
            opc   = $(this).val(),
            kit   = $('input[name="kit"]' ).val(),
            stock = $('input[name="stock"]' ).val(),
            idpro = $('input[name="img[product_id]"]').val();
        if (opc == 'brand') {
            mod  = $( "#brand_id option:selected").val();
        } else if (opc == 'section') {
            mod = $('input[name="prod[section_id]"]').val();
        } else if (opc == 'category') {
            mod = $('input[name="prod[category_id]"]').val();
        }
        
        if (mod) {
            $("#loader-grids").show();
            $("#box-grids-colors").html("");          
            $.get( base+"/product/"+idpro+"/grids/"+opc+"/"+mod+"/"+stock+"/"+kit, function( data ) {
                $("#loader-grids").hide();
                $("#box-grids-colors").html( data );
            });
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