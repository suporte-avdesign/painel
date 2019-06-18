<div class="block-title">
    <h3><span class="icon-read"> </span><strong> {{constLang('messages.catalog.title')}}</strong></h3>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{{ mix('backend/css/tables/'.$confUser->table_color.'.css') }}">

<table class="table responsive-table" id="inventory">
    <thead>
    <tr>
        <th scope="col" width="7%" class="align-center">Foto</th>
        <th scope="col" width="33%">Código</th>
        <th scope="col" width="20%" class="align-center">Unidade</th>
        <th scope="col" width="10%" class="align-center">Qtd</th>
        <th scope="col" width="10%" class="align-center">Estoque</th>
        <th scope="col" width="20%" class="align-center">Data</th>
        <th width="2%"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="7"></td>
    </tr>
    </tfoot>
</table>

<script src="{{ mix('backend/scripts/reports/inventory.min.js') }}"></script>
<script src="{{ mix('backend/js/libs/formData/jquery.form.min.js') }}"></script>

<script>
    var tableInventary = {!! json_encode([
        "id" => 'inventory',
        "url" => route('inventory.data'),
        "txtConfirm" => "Você confirma a exclusão do produto ",
        "txtCancel" => "A Exclusão foi Cancelada!",
        "txtError" => "Houve um erro no servidor!",
        "txtSave" => "Salvar",
        "txtUpdate" => "Alterar",
        "token" => csrf_token(),
        "color" => $confUser->table_color,
        "colorSel" => $confUser->table_color_sel." glossy",
        "openDetails" => $confUser->table_open_details,
        "limit" => $confUser->table_limit,
        "tableStyled" => false
    ]) !!};
</script>
<script id="painel-inventory" type="text/x-handlebars-template">
    <div id="painel_@{{{id}}}" class="content-panel margin-bottom">
        <div class="panel-navigation silver-gradient">
            <div class="panel-control"></div>
            <div class="panel-load-target scrollable" style="height:490px">
                <div class="navigable">
                    <ul class="files-list mini open-on-panel-content">
                        @can('inventory-view')
                            <li>
                                <a href="inventory/@{{{id}}}/details" class="file-link">
                                    <span class="icon file-css"></span>
                                    Perfil do Fabricante
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-content linen navigable">
            <div class="panel-control align-right">
                <div class="open-on-panel-content">
                    @can('inventory-delete')
                        <button id="btn-excluir" onclick="deleteBrand('inventory/@{{{id}}}', '@{{{name}}}');" class="button icon-trash with-tooltip red-gradient" title="Excluir Marca">Excluir
                        </button>
                    @endcan
                    @can('inventory-update')
                        <button id="btn-editar" onclick="abreModal('Alterar Marca: @{{{name}}}', 'inventory/@{{{id}}}/edit', 'inventory', 2, 'true', 300, 300);" class="button blue-gradient icon-pencil with-tooltip" title="Alterar Marca">Editar
                        </button>
                    @endcan
                </div>
            </div>

            <div class="panel-load-target scrollable with-padding" style="height:450px">
                <div class="block">
                    <div class="with-padding">

                        <h4 class="blue underline">Perfil do Fabricante</h4>
                        <p>Resta aqui</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>


<script>
    $.fn.loadTableInventory();
</script>

