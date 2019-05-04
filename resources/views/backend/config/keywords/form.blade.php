<div id="modal-keywords">
	@if(isset($data))
		<form id="form-keywords" method="POST" action="{{route('keywords.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-keywords" method="POST" action="{{route('keywords.store')}}" onsubmit="return false">
	@endif	
		{{csrf_field()}}
		<fieldset class="fieldset">
			<legend class="legend">Palavras Chaves (separadas por vírgula)</legend>
			<p class="button-height inline-label">
				<label for="title" class="label">Titulo <span class="red">*</span></label>
				<input type="text" name="title" class="input full-width" value="{{$data->title or old('title')}}" >
			</p>
			<p class="button-height inline-label">
				<label for="genders" class="label">Gêneros <span class="red">*</span></label>
				<textarea name="genders" class="input full-width" cols="50" rows="2">{{$data->genders or old('genders')}}</textarea>
			</p>
			<p class="button-height inline-label">
				<label for="categories" class="label">Categorias <span class="red">*</span></label>
				<textarea name="categories" class="input full-width" cols="50" rows="2">{{$data->categories or old('categories')}}</textarea>
			</p>
			<p class="button-height inline-label">
				<label for="description" class="label">Descrição <span class="red">*</span></label>
				<textarea name="description" class="input full-width" cols="50" rows="2">{{$data->description or old('description')}}</textarea>
			</p>
			<p class="button-height inline-label">
				<label for="keywords" class="label">Tags <span class="red">*</span></label>
				<textarea name="keywords" class="input full-width" cols="50" rows="2">{{$data->keywords or old('keywords')}}</textarea>
			</p>
			<p class="button-height inline-label">
				<label for="ordem_metodo" class="label">Status</label>
				<span class="button-group">
					<label for="status-1" class="button blue-active">
					@if(isset($data))
						<input type="radio" name="status" id="status-1" value="Ativo" {{{ $data->status == "Ativo" ? 'checked' : '' }}}>
					@else
						<input type="radio" name="status" id="status-1" value="Ativo" checked>
					@endif
						Ativo
					</label>
					<label for="status-0" class="button red-active">
					@if(isset($data))
						<input type="radio" name="status" id="status-0" value="Inativo" {{{ $data->status == "Inativo" ? 'checked' : '' }}}>
					@else
						<input type="radio" name="status" id="status-0" value="Inativo">
					@endif	
						Inativo
					</label>
				</span>
			</p>

			<p class="button-height align-center">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				<span class="button-group">
				@if(isset($data))
					@can('config-keyword-update')
						<button id="btn-modal" onclick="formKeywords('update')" class="button icon-	outbox blue-gradient"> 
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				@else
					@can('config-keyword-create')
						<button id="btn-modal" onclick="formKeywords('create')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				@endif
				</span>
			</p>
		</fieldset>
	</form>
</div>
