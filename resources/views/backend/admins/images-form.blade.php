<h4 class="blue underline">Tamanho {{$upload['width']}}x{{$upload['height']}} pixels</h4>
<div class="columns">
@if(isset($data))
	<form id="form-image"  method="post" action="{{route('foto-admin.update', ['$id' => $id, 'file' => $data->id] )}}" class="columns" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PUT">
		<input type="hidden" id="ac" name="ac" value="update">
@else
	<form id="form-image"  method="post" action="{{route('foto-admin.store', $id)}}" class="columns" enctype="multipart/form-data">
		<input type="hidden" id="ac" name="ac" value="create">
@endif
		{{csrf_field()}}
		@if(isset($data))
			<input type="hidden" name="status" value="{{$data->status}}">
		@else
		    <div class="four-columns">
				<p class="button-height">
					<span class="button-group">
						<label for="radio-0" class="button blue-active">
							<input type="radio" name="status" id="radio-0" value="Ativo" checked>Ativo
						</label>
						<label for="radio-1" class="button red-active">
							<input type="radio" name="status" id="radio-1" value="Inativo">Inativo
						</label>
					</span>
					
				</p>
		    </div>
		@endif
	    <div class="eight-columns">
	    	<p class="button-height">
				<input type="file" name="image" id="upload_file" value="" class="file" onchange="preview_image('{{$id}}', '50%');" multiple/>
			</p>
	    </div>
	    <div class="new-row twelve-columns">
	    	<div class="align-center">
				<p id="image_preview_{{$id}}">
					@if(isset($data))
						<img src="{{url($upload['photo_url'].$data->image)}}" width="50%">
					@endif
				</p>
			</div>
			@can('model-admins-update')
		        <div id="btn-upload-submit" class="align-center display-none">
					<p class="button-height align-center">						
						<button type="submit" id="btn-upload" class="button icon-cloud-upload blue-gradient display-none"> Upload </button>
					</p>
		        </div>
		    @endcan                       
	    </div>
	</form>
</div>
<script src="{{url('assets/backend/js/libs/formData/jquery.form.js')}}"></script>
