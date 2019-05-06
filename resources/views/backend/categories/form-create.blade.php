<div id="modal-categories">
	<form id="form-categories" method="POST" action="{{route('categorias.store')}}" onsubmit="return false">
	@csrf
		<fieldset class="fieldset">
			<legend class="legend">Informações da Categoria</legend>
			<p class="button-height inline-label">
				<label for="section_id" class="label">Seção </label>
				<select name="section_id" class="select">
					<option value=""> Selecione a Seção </option>
					@foreach($options as $key => $val)
						<option value="" selected>Selecione...</option>
						<option value="{{$key}}"> {{$val}} </option>
					@endforeach
				</select>
			</p>
			<p class="button-height inline-label">
				<label for="name" class="label"> Nome <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="">
			</p>
			<p class="button-height inline-label">
				<label for="tags" class="label"> Tags </label>
				<input type="text" name="tags" class="input full-width" value="">
			</p>

			@if($configModel->description == 1)
				<p class="button-height inline-label">
					<label for="description" class="label">Descrição <span class="red">*</span></label>
					<textarea name="description" class="input full-width" cols="50" rows="2"></textarea>
				</p>
			@endif


			<p class="button-height inline-label">
				<label for="status" class="label">Ordem / Status </label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="" size="2" class="input-unstyled order">
					<button type="button" class="button number-up">+</button>
				</span>

				<span class="button-group">
					<label for="status-1" class="button blue-active">
						<input type="radio" name="status" id="status-1" value="Ativo" checked="">
						Ativo
					</label>
					<label for="status-0" class="button red-active">
						<input type="radio" name="status" id="status-0" value="Inativo">
						Inativo
					</label>
				</span>
			</p>

			@if($configModel->img_featured == 1)
				<p class="button-height inline-label">
					<label for="status_featured" class="label">Status Destaque</label>
					<span class="button-group">
						<label for="status_featured-1" class="button blue-active">
							<input type="radio" name="status_featured" id="status_featured-1" value="Ativo" checked="">
							Ativo
						</label>
						<label for="status_featured-0" class="button red-active">
							<input type="radio" name="status_featured" id="status_featured-0" value="Inativo">
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
							<input type="radio" name="status_banner" id="status_banner-1" value="Ativo" checked="">
							Ativo
						</label>
						<label for="status_banner-0" class="button red-active">
							<input type="radio" name="status_banner" id="status_banner-0" value="Inativo">
							Inativo
						</label>
					</span>
				</p>
			@endif
		</fieldset>

		<p class="button-height align-center">
			<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				@can('category-create')
					<button id="btn-modal" onclick="formCategory('create')" class="button icon-publish blue-gradient"> Salvar </button>
				@endcan
			</span>
		</p>		
	</form>
</div>
