<div class="block-title">
    <h3><span class="icon-read"> </span><strong> {{$title}} </strong></h3>
    <div class="button-group absolute-right">            
            @can('category-create')                        
                <a href="javascript:void(0)" onclick="abreModal('{{$title_create}}', '{{route('categories.create')}}', 'categories', 2, 'true', {{$configModel->width_modal}}, {{$configModel->height_modal}});" class="button margin-right with-tooltip" data-tooltip-options='{"classes":["anthracite-gradient"],"position":"bottom"}' title="{{$title_create}}">Adicionar
                <span class="button-icon right-side"><span class="icon-plus-round"></span></span></a>
            @endcan

    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{{ mix('backend/css/tables/'.$confUser->table_color.'.css')}}">

<table class="table responsive-table" id="categories">
    <thead>
        <tr>
            <th width="5%">Ordem</th>
            <th width="20%" class="align-center">Nome</th>
            <th width="20%" class="align-center">Seção</th>
            <th width="10%" class="align-center">Visitas</th>
            <th class="align-center">Descrição</th>
            <th width="15%" class="align-center hide-on-mobile">Status</th>
            <th width="2%"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="7"></td>
        </tr>
    </tfoot>
</table>
<script src="{{mix('backend/scripts/categories.min.js')}}"></script>
<script>
    var tableCategory = {!! json_encode([
        "id" => 'categories',
        "url" => route('categories.data'),
        "txtConfirm" => '<small class="tag red-bg">Os produtos desta categoria serão excluidos</small><br>Você confirma a exclusão',
        "txtRemove" => '<small class="tag red-bg">A grade será excluida</small><br>Você confirma a exclusão',
        "txtCancel" => "A Exclusão foi Cancelada!",
        "txtError" => "Houve um erro no servidor!",
        "txtSave" => "Salvar",
        "txtUpdate" => "Alterar",
        "txtQty" => "Qtd",
        "txtDesc" => "Descrição",
        "textDelete" => "Excluir",
        "token" => csrf_token(),
        "color" => $confUser->table_color,
        "colorSel" => $confUser->table_color_sel." glossy",
        "openDetails" => $confUser->table_open_details,
        "limit" => $confUser->table_limit,
        "tableStyled" => false
    ]) !!};
</script>

<script id="painel-categories" type="text/x-handlebars-template">
<div id="painel_@{{{id}}}" class="content-panel margin-bottom">
    <div class="panel-navigation silver-gradient">
        <div class="panel-control">
        </div>
        <div class="panel-load-target scrollable" style="height:490px">
            <div class="navigable">
                <ul class="files-list mini open-on-panel-content">
                    @can('category-view')
                        <li>
                            <a href="category/@{{{id}}}/details" class="file-link">
                                <span class="icon file-css"></span>
                                Perfil da Categoria
                            </a>
                        </li>
                    @endcan
                    @if($configModel->grids == 1)
                        @can('category-grids-view')
                            <li>
                                <a href="category/@{{{id}}}/grids-category" class="file-link">
                                    <span class="icon file-reg"></span>
                                    Grades da Categoria
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if($configModel->img_featured == 1)
                        @can('category-images-view')
                            <li>
                                <a href="category/@{{{id}}}/featured-category" class="file-link">
                                    <span class="icon file-image"></span>
                                    Imagem Destaque
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if($configModel->img_banner == 1)
                        @can('category-images-view')
                            <li>
                                <a href="category/@{{{id}}}/banner-category" class="file-link">
                                    <span class="icon file-image"></span>
                                    Banner da Categoria
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
                @can('category-delete')
                    <button id="btn-excluir" onclick="deleteCategory('categories/@{{{id}}}', '@{{{name}}}');" class="button icon-trash with-tooltip red-gradient" title="Excluir Categoria">Excluir
                    </button>
                @endcan
                @can('category-update')
                    <button id="btn-editar" onclick="abreModal('Alterar Categoria: @{{{name}}}', 'categories/@{{{id}}}/edit', 'categories', 2, 'true', {{$configModel->width_modal}}, {{$configModel->height_modal}});" class="button blue-gradient icon-pencil with-tooltip" title="Alterar Categoria">Editar
                    </button>
                @endcan
            </div>   
        </div>

        <div class="panel-load-target scrollable with-padding" style="height:450px">
            <div class="large-box-shadow white-gradient with-border">
                <div class="with-padding">
                    <h4 class="blue underline">Perfil da Categoria</h4>
                    <p>Nome: <strong> @{{{name}}} </strong></p>
                    <p>Visitas: <strong> @{{{visits}}} </strong></p>
                    <p>Descrição: <strong> @{{{description}}} </strong></p>
                    <p>Tags: <strong> @{{{tags}}} </strong></p>
                    <p>Status Destaque:  @{{{active_featured}}}</p>
                    <p>Status Banner:  @{{{active_banner}}}</p>
                </div>
            </div>
        </div>

    </div>
</div>
</script>

<script>
$.fn.loadTableCategories();
</script>

