<h4 class="blue underline">Tamanho {{$upload['width']}}x{{$upload['height']}} pixels</h4>
<div class="columns">
	<form id="form-image"  method="post" action="{{route('banner.store', $type)}}" class="columns" enctype="multipart/form-data">
		<input type="hidden" id="ac" name="ac" value="create">
	    <input type="hidden" name="type" value="{{$type}}">
		@csrf
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
	    <div class="eight-columns">
	    	<p class="button-height">
				<input type="file" name="image" id="upload_file" value="" class="file" onchange="preview_image('{{$type}}', '70%');" multiple/>
			</p>
	    </div>
	    <div class="new-row twelve-columns">
	    	<div class="align-center">
				<p id="image_preview_{{$type}}"></p>
			</div>
			@can('images-site-create')
		        <div id="btn-upload-submit" class="align-center display-none">
					<p class="button-height align-center">
						<span class="input">
							<label for="pseudo-input-1" class="button blue-gradient">Ordem</label>
							<span class="number input margin-left" >
								<button type="button" class="button number-down">-</button>
								<input type="text" value="1" size="2" name="order" class="input-unstyled" style="width:40px">
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
