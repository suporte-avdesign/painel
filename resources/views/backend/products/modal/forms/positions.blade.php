@if(isset($data))
	<form id="form-positions" method="post" action="{{route('positions-product.update', ['idimg' => $idimg, 'id' => $data->id])}}" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PUT">
		<input name="ac" type="hidden" value="update">
@else
	<form id="form-positions" method="post" action="{{route('positions-product.store', $idpro)}}" enctype="multipart/form-data">
		<span id="insert_color">
			<!-- Jquery: Ao salvar uma cor adiciona o id da cor -->
			@if(isset($color))
				<input name="pos[image_color_id]" type="hidden" value="{{$color->id}}">
				<input name="pos[name]" type="hidden" value="{{$color->slug}}">
				<input name="pos[color]" type="hidden" value="{{$color->color}}">
				<input name="pos[code]" type="hidden" value="{{$color->code}}">
				<input name="ac" type="hidden" value="add">
			@else
				<input name="ac" type="hidden" value="create">
			@endif		
		</span>

@endif
		{{csrf_field()}}
		<div class="columns">
			<div class="five-columns twelve-columns-tablet">
				<h4 class="green underline">Status/Ordem:</h4>
				<fieldset class="fieldset">
					<p class="button-height inline-small-label">
						<label for="active" class="label">Status <span class="red">*</span></label>
						<span class="button-group">							
							<label for="active_position_1" class="button green-active">
								@if(isset($data))
									<input type="radio" name="pos[active]" id="active_position_1" value="1" @if($data->active == 1) checked @endif>
								@else
									<input type="radio" name="pos[active]" id="active_position_1" value="1" checked>
								@endif
								Ativo
							</label>
							<label for="active_position_2" class="button red-active" >
								@if(isset($data))
									<input type="radio" name="pos[active]" id="active_position_2" value="0" @if($data->active == 0) checked @endif>
								@else
									<input type="radio" name="pos[active]" id="active_position_2" value="0">
								@endif
								Inativo
							</label>
						</span>
					</p>
					<p class="button-height inline-small-label">
						<label for="order_position" class="label">Ordem <span class="red">*</span></label>
						<span class="number input margin-right">
							<button type="button" class="button number-down">-</button>
							<input type="text" name="pos[order]" value="{{$data->order or old('order')}}" size="2" class="input-unstyled order">
							<button type="button" class="button number-up">+</button>
						</span>
					</p>					
				</fieldset>
				
			</div>
			<div class="seven-columns twelve-columns-tablet">
				<h4 class="green underline">Upload da imagem:</h4>					
				<fieldset class="fieldset">
					<p class="button-height  block-label"> 
						<input type="file" name="file" id="upload_position" value="" class="file" onchange="preview_image('upload_position', 'preview_position', 200);"/>
					</p>
					<div id="preview_position" align="center">
						@if(isset($data))
							<img src="{{url($path.$data->image)}}" width="350" class="framed">
						@endif
					</div>
				</fieldset>
			</div>
		</div>
		@if(isset($data))
	        <div id="submit-position" align="center">
	            <button id="btn-position" type="submit" class="button glossy">
	                Atualizar
	                <span  class="button-icon right-side"><span class="icon-redo"></span></span>
	            </button>
	        </div>
		@else
	        <div id="submit-position" align="center">
	            <button id="btn-position" type="submit" class="button glossy">
	                Proximo
	                <span  class="button-icon right-side"><span class="icon-forward"></span></span>
	            </button>
	        </div>                         
		@endif

	</form>