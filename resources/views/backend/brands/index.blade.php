<div class="block-title">
    <h3><span class="icon-tag"> </span><strong> {{$title}} </strong></h3>
    <div class="button-group absolute-right">            
            @can('brand-create')                        
                <a href="javascript:void(0)" onclick="abreModal('{{$title_create}}', '{{route('marcas.create')}}', 'brands', 2, 'true', {{$configModel->width_modal}}, {{$configModel->height_modal}});" class="button margin-right with-tooltip" data-tooltip-options='{"classes":["anthracite-gradient"],"position":"bottom"}' title="{{$title_create}}">Adicionar 
                <span class="button-icon right-side"><span class="icon-plus-round"></span></span></a>
            @endcan

    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{!! url('assets/backend/js/libs/DataTables/'.$confUser->table_color.'.css?'.time()) !!}">

<table class="table responsive-table" id="brands">
    <thead>
        <tr>
            <th width="5%">Ordem</th>
            <th width="20%" class="align-center">Nome</th>
            <th width="10%" class="align-center">Visitas</th>
            <th class="align-center">Descrição</th>
            <th width="15%" class="align-center hide-on-mobile">Status</th>
            <th width="2%"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="6"></td>
        </tr>
    </tfoot>
</table>

<script src="{!! url('assets/backend/scripts/brands.js?'.time()) !!}"></script>
<script>
    var tableBrand = {!! json_encode([
        "id" => 'brands',
        "url" => route('brands.data'),
        "txtConfirm" => '<small class="tag red-bg">Os produtos desta marca serão excluidos</small><br>Você confirma a exclusão',
        "txtRemove" => '<small class="tag red-bg">A grade será excluida</small><br>Você confirma a exclusão',
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

<script id="painel-brands" type="text/x-handlebars-template">
<div id="painel_@{{{id}}}" class="content-panel margin-bottom">
    <div class="panel-navigation silver-gradient">
        <div class="panel-control"></div>
        <div class="panel-load-target scrollable" style="height:490px">
            <div class="navigable">
                <ul class="files-list mini open-on-panel-content">
                    @can('brand-view')
                        <li>
                            <a href="marca/@{{{id}}}/detalhes" class="file-link">
                                <span class="icon file-css"></span>
                                Perfil do Fabricante
                            </a>
                        </li>
                    @endcan
                    @if($configModel->grids == 1)
                        @can('brand-grids-view')
                            <li>
                                <a href="marca/@{{{id}}}/grids-brand" class="file-link">
                                    <span class="icon file-reg"></span>
                                    Grades do Fabricante
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if($configModel->img_logo == 1)
                        @can('brand-images-view')
                            <li>
                                <a href="marca/@{{{id}}}/logo-brand" class="file-link">
                                    <span class="icon file-image"></span>
                                    Logo da Marca
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if($configModel->img_banner == 1)
                        @can('brand-images-view')
                            <li>
                                <a href="marca/@{{{id}}}/banner-brand" class="file-link">
                                    <span class="icon file-image"></span>
                                    Banner da Marca
                                </a>
                            </li>
                        @endcan
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="panel-content linen navigable">

        <div class="panel-control align-right">
            <div class="open-on-panel-content">
                @can('brand-delete')
                    <button id="btn-excluir" onclick="deleteBrand('marcas/@{{{id}}}', '@{{{name}}}');" class="button icon-trash with-tooltip red-gradient" title="Excluir Marca">Excluir
                    </button>
                @endcan
                @can('brand-update')
                    <button id="btn-editar" onclick="abreModal('Alterar Marca: @{{{name}}}', 'marcas/@{{{id}}}/edit', 'brands', 2, 'true', {{$configModel->width_modal}}, {{$configModel->height_modal}});" class="button blue-gradient icon-pencil with-tooltip" title="Alterar Marca">Editar
                    </button>
                @endcan
            </div>   
        </div>

        <div class="panel-load-target scrollable with-padding" style="height:450px">
            <div class="block">
                <div class="with-padding">
                    <h4 class="blue underline">Perfil do Fabricante</h4>
                    <ul class="bullet-list">
                        <li>Nome: <strong> @{{{name}}} </strong></li>
                        <li>Visitas: <strong> @{{{visits}}} </strong></li>
                        <li>Descrição:  <strong> @{{{description}}}</strong> </li>
                        <li>Tags:  <strong>@{{{tags}}}</strong></li>                        
                        <li>Status Logo:  @{{{status_logo}}}</li>
                        <li>Status Banner:  @{{{status_banner}}}</li>
                        @if($configModel->info == 1)
                            <li>Email: <strong> @{{{email}}} </strong></li>
                            <li>Telefone: <strong> @{{{phone}}} </strong></li>
                            <li>Endereço: <strong> @{{{address}}}, @{{{number}}}</strong></li>
                            <li>Bairro: <strong> @{{{district}}} </strong></li>
                            <li>Cidade: <strong> @{{{city}}} - @{{{state}}}</strong></li>
                            <li>CEP: <strong>@{{{zip_code}}}</strong> </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</script>

<script>
$.fn.loadTableBrands();
</script>

