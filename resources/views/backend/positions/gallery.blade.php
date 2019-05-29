<div id="data-positions-{{$idpro}}">
	<div class="block-title silver-gradient">
		<h3>
			<i class="fa fa-cog" aria-hidden="true"></i>
			<strong> {{$title_count}} </strong>
		</h3>
	</div>
	<div class="with-padding silver-gradient">
		@foreach($colors as $color)
			<ul class="list spaced">
				<li>
					<h4 class="big-text blue underline"><span class="icon-blue icon-size1 icon-camera"></span><strong> Cor: {{$color->color}}</strong></h4>
					<div class="button-group absolute-right compact">
						<a href="javascript:void(0)"
							onclick="abreModal('Adicionar: Posição', '{{route('positions-product.create', $color->id)}}', 'form-positions', 2, 'true',800,780);"
							class="button icon-camera blue-gradient glossy">Adicionar
						</a>
					</div>
				</li>
			</ul>
			<ul id="gallery-positions-{{$color->id}}" class="gallery">
				@foreach($color->positions->sortBy('order') as $position)
					<li id="img-positions-{{$position->id}}">					
						<img src="{{url($path.$position->image)}}" class="framed">
						<div class="controls">
							@php
								($position->active == 1 ? $col = 'green' : $col = 'red');
							@endphp
							<span id="btns-{{$position->id}}" class="button-group compact children-tooltip">
								<button id onclick="statusPosition('{{$position->id}}','{{route('status-position', $position->id)}}','{{$position->active}}','{{csrf_token()}}');" class="button icon-tick {{$col}}-gradient" title="Alterar status"></button>
								<button onclick="abreModal('Editar: Posição', '{{route('positions-product.edit', ['idimg' => $position->image_color_id,'id' => $position->id])}}', 'form-positions', 2, 'true',800,780);" class="button" title="Editar imagem">Editar</button>
								<button onclick="deletePosition('{{$position->id}}', '{{route('positions-product.destroy', ['idimg' => $position->image_color_id, 'id' => $position->id])}}');" class="button icon-trash red-gradient" title="Excluir imagem"></button>
							</span>
						</div>
					</li>
				@endforeach	
			</ul>
		@endforeach
	</div>
</div>