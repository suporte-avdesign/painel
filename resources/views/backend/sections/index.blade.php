<div class="block-title">
    <h3><span class="icon-read"> </span><strong> {{$title}} </strong></h3>
    <div class="button-group absolute-right">            
            @can('section-create')                        
                <a href="javascript:void(0)" onclick="abreModal('{{$title_create}}', '{{route('secoes.create')}}', 'sections', 2, 'true', {{$configModel->width_modal}}, {{$configModel->height_modal}});" class="button margin-right with-tooltip" data-tooltip-options='{"classes":["anthracite-gradient"],"position":"bottom"}' title="{{$title_create}}">Adicionar 
                <span class="button-icon right-side"><span class="icon-plus-round"></span></span></a>
            @endcan

    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{!! url('assets/backend/js/libs/DataTables/'.$confUser->table_color.'.css?'.time()) !!}">

<table class="table responsive-table" id="sections">
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

<script src="{!! url('assets/backend/scripts/sections.js?'.time()) !!}"></script>
<script>
    var tableSection = {!! json_encode([
        "id" => 'sections',
        "url" => route('sections.data'),
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

<script id="painel-sections" type="text/x-handlebars-template">
<div id="painel_@{{{id}}}" class="content-panel margin-bottom">
    <div class="panel-navigation silver-gradient">
        <div class="panel-control">
        </div>
        <div class="panel-load-target scrollable" style="height:490px">
            <div class="navigable">
                <ul class="files-list mini open-on-panel-content">
                    @can('section-view')
                        <li>
                            <a href="secao/@{{{id}}}/detalhes" class="file-link">
                                <span class="icon file-css"></span>
                                Perfil da Seção
                            </a>
                        </li>
                    @endcan
                    @if($configModel->grids == 1)
                        @can('section-grids-view')
                            <li>
                                <a href="secao/@{{{id}}}/grids-section" class="file-link">
                                    <span class="icon file-reg"></span>
                                    Grades da Seção
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if($configModel->img_featured == 1)
                        @can('section-images-view')
                            <li>
                                <a href="secao/@{{{id}}}/featured-section" class="file-link">
                                    <span class="icon file-image"></span>
                                    Imagem Destaque
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if($configModel->img_banner == 1)
                        @can('section-images-view')
                            <li>
                                <a href="secao/@{{{id}}}/banner-section" class="file-link">
                                    <span class="icon file-image"></span>
                                    Banner da Seção
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
                @can('section-delete')
                    <button id="btn-excluir" onclick="deleteSection('secoes/@{{{id}}}', '@{{{name}}}');" class="button icon-trash with-tooltip red-gradient" title="Excluir Seção">Excluir
                    </button>
                @endcan
                @can('section-update')
                    <button id="btn-editar" onclick="abreModal('Alterar Seção: @{{{name}}}', 'secoes/@{{{id}}}/edit', 'sections', 2, 'true', {{$configModel->width_modal}}, {{$configModel->height_modal}});" class="button blue-gradient icon-pencil with-tooltip" title="Alterar Seção">Editar
                    </button>
                @endcan
            </div>   
        </div>

        <div class="panel-load-target scrollable with-padding" style="height:450px">
            <div class="block">
                <div class="with-padding">
                    <h4 class="blue underline">Perfil da Seção</h4>
                    <ul class="bullet-list">
                        <li>Nome: <strong> @{{{name}}} </strong></li>
                        <li>Visitas: <strong> @{{{visits}}} </strong></li>
                        <li>Descrição: <strong> @{{{description}}} </strong></li>
                        <li>Tags: <strong> @{{{tags}}} </strong></li>
                        <li>Status Destaque:  @{{{status_featured}}}</li>
                        <li>Status Banner:  @{{{status_banner}}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</script>

<script>
$.fn.loadTableSections();
</script>

