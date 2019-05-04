<dl class="accordion same-height">
	@foreach($methods as $method)
		<dt id="method-{{$method->id}}"><strong>{{$method->order}}</strong> - {{$method->name}}
			<div class="button-group absolute-right compact margin">
				<a href="javascript:deleteShipping('method-{{$method->id}}', '{{route('metodos.destroy', $method->id)}}', '{{csrf_token()}}')" class="button icon-trash with-tooltip confirm red-gradient" title="Excluir"></a>
				<button onclick="abreModal('Editar {{$method->name}}', '{{route('metodos.edit', $method->id)}}', 'shippings', 2, true, 400, 250)" class="button icon-pencil">Editar</button>

			</div>	
		</dt>
		<dd>
			<div class="with-padding">						
				<strong>Descrição: </strong>{{$method->description}}
			</div>
		</dd>
	@endforeach
</dl>

