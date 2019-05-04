<div class="block-title silver-gradient">
	<h3>
		<i class="fa fa-cog" aria-hidden="true"></i>
		<strong> {{$title}} </strong>
	</h3>
	<div class="button-group absolute-right compact">
		    <button 
    			onclick="abreModal('Adicionar Método', '{{route('metodos.create')}}', 'name', 2, true, 400, 250)" 
    			class="button icon-plus-round with-tooltip blue-gradient" 
    			title="Adicionar Método">Adicionar
    		</button>

	</div>	
</div>
<div class="silver-gradient">
	<div id="shippings" class="with-padding">
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
	</div>
</div>
<script src="{{url('assets/backend/scripts/settings/shippings.js')}}?{{time()}}"></script>