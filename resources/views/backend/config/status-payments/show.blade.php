<dl class="accordion same-height">
	@foreach($data as $value)
		<dt id="status-payments-{{$value->id}}"><strong>{{$value->order}}</strong> - {{$value->label}}
			<div class="button-group absolute-right compact margin">
				<a href="javascript:deleteStatusPayments('status-payments-{{$value->id}}', '{{route('status-pagamentos.destroy', $value->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip confirm red-gradient" title="Excluir"></a>
				<button onclick="abreModal('Editar {{$value->label}}', '{{route('status-pagamentos.edit', $value->id)}}', 'status-payments', 2, true, 400, 250)" class="button icon-pencil">Editar</button>
			</div>
		</dt>
		<dd>
			<div class="with-padding">						
				<strong>Descrição: </strong>{{$value->description}}
			</div>
		</dd>
	@endforeach
</dl>

