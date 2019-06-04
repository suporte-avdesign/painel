<fieldset class="fieldset">
    <!-- Legends of input informations -->
    @if($stock == 1)
        @if($kit == 1)
            <legend class="legend">Quantidade | Grade</legend>
        @else
            <legend class="legend">Grade | Entada | Estoque </legend>
        @endif
    @else
        @if($kit == 1)
            <legend class="legend">Quantidade | Grade</legend>
        @else
            <legend class="legend">Grades  </legend>
        @endif
    @endif
    @if($stock == 0)
        <div class="align-right compact">
            <a href="javascript:createGrid('{{$data->id}}','{{$stock}}','{{$kit}}');" class="button icon-plus blue-gradient" title="Adicionar"></a>
        </div>
    @endif
    <div id="update-grids">
        @if($kit == 1)
            @if($stock == 1)
                @include('backend.colors-grids.form-edit-kits-stock')
            @else
                @include('backend.colors-grids.form-edit-kits')
            @endif
        @else
            @include('backend.colors-grids.form-edit-units')
        @endif
    </div>
</fieldset>

<div align="center">
    <span id="loader-grids" class="loader working" style="display:none;"></span>
</div>  
<div id="box-grids-colors"></div>

@include('backend.colors-grids.load-script')

<script>
    function createGrid(id, stock, kit) {
        if (stock == 1) {

            if (kit == 1) {
                /**
                 *  stock=1 type grid=kit
                 */
                $("#grids-"+id).prepend('<li id="new-grid-'+id+'">'+
                    '<span class="input">'+
                    '<input type="text" name="grids['+id+'][qty]"  id="qty_'+id+'" value="" autocomplete="off" placeholder="Qtd" maxlength="4" class="input-unstyled input-sep" style="width: 60px;">'+
                    '<input type="text" name="grids['+id+'][grid]" id="grid_'+id+'" value="" autocomplete="off" placeholder="Grade" maxlength="6" class="input-unstyled" style="width: 60px;">'+
                    '</span>'+
                    '<div class="button-group absolute-right compact">'+
                    '<button onclick="destroyGrid('+id+')" class="button icon-trash with-tooltip red-gradient" title="Excluir"></button>'+
                    '</div></li>');
            } else {
                /**
                 *  stock=1 type grid=unit
                 */
                $("#grids-"+id).prepend('<li id="new-grid-'+id+'">'+
                    '<span class="input">'+
                    '<input type="text" name="grids['+id+'][grid]" id="grid_'+id+'" value="" autocomplete="off" placeholder="Grade" maxlength="6" class="input-unstyled input-sep" style="width: 50px;">'+
                    '<input type="text" name="grids['+id+'][qty]"  id="qty_'+id+'" value="" autocomplete="off" placeholder="Entrada" maxlength="4" class="input-unstyled" style="width: 50px;">'+
                    '</span>'+
                    '<div class="button-group absolute-right compact">'+
                    '<button onclick="destroyGrid('+id+')" class="button icon-trash with-tooltip red-gradient" title="Excluir"></button>'+
                    '</div></li>');
            }
        } else {

            if (kit == 1) {
                /**
                 *  stock=0 type grid=unit
                 */
                $("#grids-"+id).prepend('<li id="new-grid-'+id+'">'+
                    '<span class="input">'+
                    '<input type="text" name="grids['+id+'][qty]"  id="qty_'+id+'" value="" autocomplete="off" placeholder="Qtd" maxlength="4" class="input-unstyled input-sep" style="width: 60px;">'+
                    '<input type="text" name="grids['+id+'][grid]" id="grid_'+id+'" value="" autocomplete="off" placeholder="Grade" maxlength="6" class="input-unstyled" style="width: 60px;">'+
                    '</span>'+
                    '<div class="button-group absolute-right compact">'+
                    '<button onclick="destroyGrid('+id+')" class="button icon-trash with-tooltip red-gradient" title="Excluir"></button>'+
                    '</div></li>');

            } else {
                /**
                 *  stock=0 type grid=unit
                 */
                $("#grids-" + id).prepend('<li id="new-grid-' + id + '">' +
                    '<span class="input">' +
                    '<input type="text" name="grids[' + id + '][grid]" id="grid_' + id + '" value="" autocomplete="off" placeholder="Grade" maxlength="6" class="input-unstyled input-sep" style="width: 50px;">' +
                    '</span>' +
                    '<div class="button-group absolute-right compact">' +
                    '<button onclick="destroyGrid(' + id + ')" class="button icon-trash with-tooltip red-gradient" title="Excluir"></button>' +
                    '</div></li>');
            }
        }

    }

    function destroyGrid(id) {
        $("#new-grid-"+id).remove();
    }
</script>
