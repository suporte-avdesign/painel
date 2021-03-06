@if($type == 'four')
	<p class="message icon-info-round white-gradient">Os banner são visualizados pela ordem (Largura:{{$upload['width']}} pxels / Altura:{{$upload['height']}} pxels).</p>
@endif
@can('images-site-create')
	<div class="align-right">
		<a href="javascript:void(0)" onclick="abreModal('{{$upload['btn']['create']}}: {{$type}}', '{{route('banner.create', $type)}}', 'form-image', 2, 'true', 460, 460);" class="button">
			<span class="button-icon blue-gradient glossy"><span class="icon-camera"></span></span>
			{{$upload['btn']['create']}}
		</a>
	</div>
@endcan

@can('images-site-view')
	<ul id="gallery-{{$type}}" class="gallery">
		@foreach($data as $file)
			@if($type == $file->type)
				<li class="square" id="img-{{$file->id}}">
					<img src="{{url($upload['photo_url'].$file->image)}}" class="framed">
					<div class="controls">
						<span id="btns-{{$file->id}}" class="button-group compact children-tooltip">
							@if($file->status == 'Ativo')
								<button id="status-{{$file->id}}" onclick="statusImage('{{$file->id}}', '{{route('banner.status', $file->id)}}', '{{csrf_token()}}')" class="button icon-tick green-gradient" title="{{$upload['btn']['status']}}"></button>
							@else
								<button id="status-{{$file->id}}" onclick="statusImage('{{$file->id}}', '{{route('banner.status', $file->id)}}', '{{csrf_token()}}')" class="button icon-tick red-gradient" title="{{$upload['btn']['status']}}"></button>
							@endif
							<button id="order-{{$file->id}}" class="button" title="{{$upload['btn']['order']}}">{{$upload['btn']['order']}} ({{$file->order}})</button>
							<button id="edit-{{$file->id}}" onclick="abreModal('Editar: {{$file->type}}', '{{route('banner.edit', ['type' => $file->type, 'id' => $file->id])}}', 'form-image', 2, 'true', 500, 400);" class="button" title="{{$upload['btn']['edit']}}">{{$upload['btn']['edit']}}</button>
							<button id="delete-{{$file->id}}" onclick="deleteImage('{{$file->id}}', '{{route('banner.destroy', ['type' => $file->type, 'id' => $file->id])}}', '{{csrf_token()}}')" class="button icon-trash red-gradient" title="{{$upload['btn']['delete']}}"></button>
						</span>
					</div>
				</li>
				<script>$("#order-{{$file->id}}").menuTooltip("Carregando...",{classes:["with-mid-padding"],ajax:"images/banner/order/{{$file->id}}",onShow:function(e){e.parent().removeClass("show-on-parent-hover")},onRemove:function(e){e.parent().addClass("show-on-parent-hover")}});</script>
			@endif
		@endforeach
	</ul>
	<script src="{{mix('backend/scripts/banners.min.js')}}"></script>
@endcan