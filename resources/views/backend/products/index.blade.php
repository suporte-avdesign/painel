<div class="block-title">
    <h3><span class="icon-read"> </span><strong> {{$title}} {{$data->name}} / {{$data->section}}</strong></h3>
    <div class="button-group absolute-right">            
            @can('product-create')                        
                <a href="javascript:void(0)" onclick="abreModal('{{$title_create}} {{$data->name}} / {{$data->section}}', '{{route('catalogo.create', $data->id)}}', 'products', 2, 'true', 800, 780);" class="button margin-right with-tooltip" data-tooltip-options='{"classes":["anthracite-gradient"],"position":"bottom"}' title="{{$title_create}}">Adicionar 
                <span class="button-icon right-side"><span class="icon-plus-round"></span></span></a>
            @endcan

    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{!! url('assets/backend/js/libs/DataTables/'.$confUser->table_color.'.css?'.time()) !!}">

<table class="table responsive-table" id="products">
    <thead>
        <tr>
            <th scope="col" width="7%" class="align-center">Foto</th>
            <th scope="col" width="20%" class="align-center">Visitas</th>
            <th scope="col" width="20%" class="align-center">Oferta</th>
            <th scope="col" width="10%" class="align-center">Status</th>
            <th scope="col" width="10%" class="align-center">Destaque</th>
            <th scope="col" width="10%" class="align-center">Novo</th>
            <th scope="col" width="10%" class="align-center">Tendência</th>
            <th scope="col" width="10%" class="align-center">Black Friday</th>
            <th width="2%"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="9"></td>
        </tr>
    </tfoot>
</table>

<script src="{!! url('assets/backend/scripts/products.js?'.time()) !!}"></script>
<script src="{{url('assets/backend/js/libs/formData/jquery.form.js')}}"></script>

<script>   
    var tableProduct = {!! json_encode([
        "id" => 'products',
        "url" => route('catalogo.data', $data->id),
        "txtUpdateGrids" => 'Você confirma a alteração da grade para ',
        "txtUpdateGridsStock" => '<small class="tag red-bg">O Estoque será zerado</small><br> Você confirma a alteração da grade para ',
        "txtUpdateStock" => '<small class="tag red-bg">O Estoque será zerado</small><br> Você confirma?',
        "txtConfirm" => "Você confirma a exclusão do produto ",
        "txtCancel" => "A ação foi cancelada!",
        "txtError" => "Houve um erro no servidor!",
        "txtNext" => "Proximo",
        "txtSave" => "Salvar",
        "txtUpdate" => "Alterar",
        "txtGrid" => "Grade",
        "txtEntry" => "Entrada",
        "txtLow" => "Saida",
        "txtKit" => "Caixa",
        "txtUnit" => "Unidade",
        "txtLoader" => "Aguarde",
        "token" => csrf_token(),
        "color" => $confUser->table_color,
        "colorSel" => $confUser->table_color_sel." glossy",
        "openDetails" => $confUser->table_open_details,
        "limit" => $confUser->table_limit,
        "tableStyled" => false
    ]) !!};
</script>

<script id="painel-products" type="text/x-handlebars-template">
<div id="painel_@{{{id}}}" class="content-panel margin-bottom">
    <div class="panel-navigation silver-gradient">
        <div class="panel-control">
        </div>
        <div class="panel-load-target scrollable" style="height:490px">
            <div class="navigable">
                <ul class="files-list mini open-on-panel-content">
                    @can('product-view')
                        <li>
                            <a href="produto/@{{{id}}}/detalhes" class="file-link">
                                <span class="icon file-css"></span>
                                Detalhes do Produto
                            </a>
                        </li>
                    @endcan
                    @can('product-images-view')
                        <li>
                            <a href="produto/@{{{id}}}/colors-product" class="file-link">
                                <span class="icon folder-image"></span>
                                Editar Cores
                            </a>
                        </li>
                    @endcan
                    @if($configProduct->positions == 1)
                        @can('product-images-view')
                            <li>
                                <a href="produto/@{{{id}}}/positions-product" class="file-link">
                                    <span class="icon folder-image"></span>
                                    Editar Posições
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
                @can('product-delete')
                    <button id="btn-excluir" onclick="deleteProduct('produtos/{{$data->slug}}/catalogo/@{{{id}}}', '@{{{name}}}');" class="button icon-trash with-tooltip red-gradient" title="Excluir Categoria">Excluir
                    </button>
                @endcan
                @can('product-update')
                    <button id="btn-editar"  onclick="abreModal('Editar Produto {{$data->name}} / {{$data->section}}', 'produtos/{{$data->slug}}/catalogo/@{{{id}}}/edit', 'products', 2, 'true', 800, 780);" class="button blue-gradient icon-pencil with-tooltip" title="Alterar Produto">Editar
                    </button>
                @endcan
            </div>   
        </div>

        <div id="info-product-@{{{id}}}"  class="panel-load-target scrollable with-padding" style="height:450px">
            <div class="block">
                <div class="with-padding">
                    <h4 class="blue underline">Perfil do Produto</h4>
                    <ul class="bullet-list">
                        <li>Nome: <strong> @{{{name}}} </strong></li>
                        <li>Descrição: <strong> @{{{description}}} </strong></li>
                        <li>Tags: <strong> @{{{tags}}} </strong></li>
                        @{{{cost}}}
                        @{{{sum_stock}}}
                        @{{{kit}}}
                        <li>Unidade Medida: <strong>  @{{{unit}}} @{{{measure}}} </strong></li>
                        @{{{prices}}}
                        @{{{freight}}}
                        @{{{video}}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</script>

<script>
$.fn.loadTableProducts();
</script>

