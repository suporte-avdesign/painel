<h4 class="blue underline">Tamanho {{$upload['width']}}x{{$upload['height']}} pixels</h4>
<div class="columns">
	<form id="form-image"  method="post" action="{{route($upload['type'].'-slider.update', ['$id' => $id, 'file' => $data->id] )}}" class="columns" enctype="multipart/form-data">
		<input type="hidden" id="ac" name="ac" value="update">
		<input type="hidden" name="type" value="{{$upload['type']}}">
		<input type="hidden" name="status" value="{{$data->status}}">
		@method("PUT")
		@csrf
	    <div class="eight-columns">
			<p>aqui</p>
	    	<p class="button-height">
				<input type="file" name="image" id="upload_file" value="" class="file" onchange="preview_image('{{$id}}', '60%');" multiple/>
			</p>
	    </div>
	    <div class="new-row twelve-columns">
	    	<div class="align-center">
				<p id="image_preview_{{$id}}"><img src="{{url($upload['photo_url'].$data->image)}}" width="60%"></p>
			</div>
			@can('slider-images-create')
		        <div id="btn-upload-submit" class="align-center display-none">
					<p class="button-height align-center">

						<span class="input">
							<label for="pseudo-input-1" class="button blue-gradient">Ordem</label>
							<span class="number input margin-left" >
								<button type="button" class="button number-down">-</button>
								<input type="text" value="" size="2" name="order" class="input-unstyled" style="width:40px">
								<button type="button" class="button number-up">+</button>
							</span>
							<button type="submit" id="btn-upload" class="button icon-cloud-upload blue-gradient display-none"> Upload </button>
						</span>
					</p>
		        </div>
		    @endcan                       
	    </div>
	</form>
</div>

<script src="{{url('assets/backend/js/libs/formData/jquery.form.js')}}"></script>
