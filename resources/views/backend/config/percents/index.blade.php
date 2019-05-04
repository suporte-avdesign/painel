<div class="block-title silver-gradient">
    <h3>
        <span class="icon-tag">
        <strong> {{$title}} </strong>
        </span>
    </h3>
    @can('config-percent-ceate')
        <span class="button-group absolute-right with-tooltip">
            <button 
                onclick="abreModal('{{$title_create}}', '{{route('porcentagens.create')}}', 'percents', 2, true, 380, 200)" 
                class="button icon-plus-round with-tooltip anthracite-gradient" 
                title="{{$title_create}}">Adicionar
            </button>
        </span>
    @endcan
</div>

<!-- DataTables -->
<link rel="stylesheet" href="{!! url('assets/backend/js/libs/DataTables/'.$confUser->table_color.'.css')!!}">

<table class="table responsive-table" id="percents">
	<thead>
		<tr>
            <th scope="col" width="10%" class="align-center">Ordem</th>
			<th scope="col" width="25%" class="align-center">Porcentagem</th>
            <th scope="col" class="align-center">Status</th>
			<th scope="col" width="10%" class="align-center">Ações</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="4"></td>
		</tr>
	</tfoot>
</table>

<script src="{{url('assets/backend/scripts/settings/percents.js')}}?{{time()}}"></script>
<script>
    var avdTable = {!! json_encode([
        "id" => 'percents',
        "url" => route('percent.data'),
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
$.fn.loadTablePercents();    
</script>
