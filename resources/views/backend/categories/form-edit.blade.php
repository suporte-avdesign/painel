<div id="modal-categories">
@if(isset($data))
	<form id="form-categories" method="POST" action="{{route('categorias.update', $data->id)}}" onsubmit="return false">
		<input name="_method" type="hidden" value="PUT">
@else
	<form id="form-categories" method="POST" action="{{route('categorias.store')}}" onsubmit="return false">
@endif	
	{{csrf_field()}}
		<fieldset class="fieldset">
			<legend class="legend">Informações da Categoria</legend>
			<p class="button-height inline-label">
				<label for="section_id" class="label">Seção </label>
				<select name="section_id" class="select">
					<option value=""> Selecione a Seção </option>
					@foreach($options as $key => $val)
						<option value="{{$key}}" @if($data->section_id == $key) selected @endif> {{$val}} </option>
					@endforeach
				</select>
			</p>
			<p class="button-height inline-label">
				<label for="name" class="label"> Nome <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name}}">
			</p>
			<p class="button-height inline-label">
				<label for="tags" class="label"> Tags </label>
				<input type="text" name="tags" class="input full-width" value="{{$data->tags}}">
			</p>

			@if($configModel->description == 1)
				<p class="button-height inline-label">
					<label for="description" class="label">Descrição <span class="red">*</span></label>
					<textarea name="description" class="input full-width" cols="50" rows="2">{{$data->description}}</textarea>
				</p>
			@endif


			<p class="button-height inline-label">
				<label for="status" class="label">Ordem / Status </label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order}}" size="2" class="input-unstyled order">
					<button type="button" class="button number-up">+</button>
				</span>

				<span class="button-group">
					<label for="status-1" class="button blue-active">
						<input type="radio" name="status" id="status-1" value="Ativo" @if($data->status == 'Ativo') checked @endif>
						Ativo
					</label>
					<label for="status-0" class="button red-active">
						<input type="radio" name="status" id="status-0" value="Inativo" @if($data->status == 'Inativo') checked @endif>
						Inativo
					</label>
				</span>
			</p>

			@if($configModel->img_featured == 1)
				<p class="button-height inline-label">
					<label for="status_featured" class="label">Status Destaque</label>
					<span class="button-group">
						<label for="status_featured-1" class="button blue-active">
							<input type="radio" name="status_featured" id="status_featured-1" value="Ativo" @if($data->status_featured == 'Ativo') checked @endif>
							Ativo
						</label>
						<label for="status_featured-0" class="button red-active">
							<input type="radio" name="status_featured" id="status_featured-0" value="Inativo" @if($data->status_featured == 'Inativo') checked @endif>
							Inativo
						</label>
					</span>
				</p>
			@endif

			@if($configModel->img_banner == 1)
				<p class="button-height inline-label">
					<label for="status_banner" class="label">Status Banner </label>
					<span class="button-group">
						<label for="status_banner-1" class="button blue-active">
							<input type="radio" name="status_banner" id="status_banner-1" value="Ativo" @if($data->status_banner == 'Ativo') checked @endif>
							Ativo
						</label>
						<label for="status_banner-0" class="button red-active">
							<input type="radio" name="status_banner" id="status_banner-0" value="Inativo" @if($data->status_banner == 'Inativo') checked @endif>
							Inativo
						</label>
					</span>
				</p>
			@endif
		</fieldset>

		<p class="button-height align-center">
			<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				@can('category-update')
					<button id="btn-modal" onclick="formCategory('update')" class="button icon-publish blue-gradient"> Alterar </button>
				@endcan
			</span>
		</p>		
	</form>
</div>
