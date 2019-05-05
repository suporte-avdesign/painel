<div id="modal-keywords">
	<form id="form-keywords" method="POST" action="{{route('keywords.store')}}" onsubmit="return false">
	@csrf
		<fieldset class="fieldset">
			<legend class="legend">Palavras Chaves (separadas por vírgula)</legend>
			<p class="button-height inline-label">
				<label for="title" class="label">Titulo <span class="red">*</span></label>
				<input type="text" name="title" class="input full-width" value="" >
			</p>
			<p class="button-height inline-label">
				<label for="genders" class="label">Gêneros <span class="red">*</span></label>
				<textarea name="genders" class="input full-width" cols="50" rows="2"></textarea>
			</p>
			<p class="button-height inline-label">
				<label for="categories" class="label">Categorias <span class="red">*</span></label>
				<textarea name="categories" class="input full-width" cols="50" rows="2"></textarea>
			</p>
			<p class="button-height inline-label">
				<label for="description" class="label">Descrição <span class="red">*</span></label>
				<textarea name="description" class="input full-width" cols="50" rows="2"></textarea>
			</p>
			<p class="button-height inline-label">
				<label for="keywords" class="label">Tags <span class="red">*</span></label>
				<textarea name="keywords" class="input full-width" cols="50" rows="2"></textarea>
			</p>
			<p class="button-height inline-label">
				<label for="ordem_metodo" class="label">Status</label>
				<span class="button-group">
					<label for="status-1" class="button blue-active">
						<input type="radio" name="status" id="status-1" value="Ativo" checked>
						Ativo
					</label>
					<label for="status-0" class="button red-active">
						<input type="radio" name="status" id="status-0" value="Inativo">
						Inativo
					</label>
				</span>
			</p>

			<p class="button-height align-center">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				<span class="button-group">
					@can('config-keyword-create')
						<button id="btn-modal" onclick="formKeywords('create')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				</span>
			</p>
		</fieldset>
	</form>
</div>
