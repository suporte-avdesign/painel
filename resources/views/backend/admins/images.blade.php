<div class="block" id="image-admin-{{$id}}">
    <div class="block-title silver-gradient">
        <h4><span class="icon icon-camera"></span> {{$title}}</h4>
        @can('model-admins-update')
	        <div class="button-group absolute-right compact">
	            <a href="javascript:void(0)" onclick="abreModal('{{$upload['btn']['create']}}: Foto', '{{route('foto-admin.create', $id)}}', 'form-image', 2, 'true', 500, 400);" class="button icon-plus-round blue-gradient glossy">{{$upload['btn']['create']}}
				</a>
	        </div>
	    @endcan
    </div>
    <div class="with-padding">
		<ul id="gallery-{{$id}}" class="gallery">
		    @foreach($data as $file)
				<li id="img-{{$file->id}}">
					<img src="{{url($upload['path'].$file->image)}}" class="framed">
					<div class="controls">
						<span id="btns-{{$file->id}}" class="button-group compact children-tooltip">
							@if($file->status == 'Ativo')
								<button id="status-{{$file->id}}" onclick="statusImage('{{$file->id}}', '{{route('photo.admin.status', $file->id)}}', '{{csrf_token()}}')" class="button icon-tick green-gradient" title="{{$upload['btn']['status']}}"></button>
							@else
								<button id="status-{{$file->id}}" onclick="statusImage('{{$file->id}}', '{{route('photo.admin.status', $file->id)}}', '{{csrf_token()}}')" class="button icon-tick red-gradient" title="{{$upload['btn']['status']}}"></button>
							@endif
							<button id="edit-{{$file->id}}" onclick="abreModal('Editar Foto', '{{route('foto-admin.edit', ['$id' => $id, 'file' => $file->id])}}', 'form-image', 2, 'true', 500, 400);" class="button" title="{{$upload['btn']['edit']}}">{{$upload['btn']['edit']}}</button>
							<button id="delete-{{$file->id}}" onclick="deleteImage('{{$file->id}}', '{{route('foto-admin.destroy', ['id' => $id, 'file' => $file->id])}}', '{{csrf_token()}}')" class="button icon-trash red-gradient" title="{{$upload['btn']['delete']}}"></button>
						</span>
					</div>
				</li>
			@endforeach
		</ul>
	</div>    
</div>