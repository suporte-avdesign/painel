<div class="block-title silver-gradient">
    <h3>
        <span class="icon-tag">
        <strong> {{$title}} </strong>
        </span>
    </h3>
    @can('config-kit-ceate')
        <span class="button-group absolute-right with-tooltip">
            <button 
                onclick="abreModal('{{$title_create}}', '{{route('kits.create')}}', 'kits', 2, true, 400, 220)" 
                class="button icon-plus-round with-tooltip anthracite-gradient" 
                title="{{$title_create}}">Adicionar
            </button>
        </span>
    @endcan
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{!! url('assets/backend/js/libs/DataTables/'.$confUser->table_color.'.css')!!}">

<table class="table responsive-table" id="kits">
	<thead>
		<tr>
            <th scope="col" width="10%" class="align-center">Ordem</th>
            <th scope="col" class="align-center">Nome</th>
            <th scope="col" width="10%" class="align-center">Status</th>
			<th scope="col" width="20%" class="align-center">Ações</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="4"></td>
		</tr>
	</tfoot>
</table>

<script src="{{url('assets/backend/scripts/settings/kits.js')}}?{{time()}}"></script>
<script>
    var avdTable = {!! json_encode([
        "id" => 'kits',
        "url" => route('config.kits.data'),
        "txtConfirm" => "Você confirma a exclusão",
        "txtCancel" => "A Exclusão foi Cancelada!",
        "txtError" => "Houve um erro no servidor!",
        "txtLoader" => "Aguarde",
        "txtSave" => "Salvar",
        "txtUpdate" => "Alterar",
        "token" => csrf_token(),
        "color" => $confUser->table_color,
        "limit" => $confUser->table_limit,
        "tableStyled" => false
    ]) !!};
</script>

<script>
$.fn.loadTableKits();    
</script>
