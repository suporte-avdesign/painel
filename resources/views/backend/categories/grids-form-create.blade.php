<div id="modal-category-grids">
	<form id="form-category-grids" method="POST" action="{{route('grids-category.store', $id)}}" onsubmit="return false">
	@csrf
		<fieldset class="fieldset">
			<legend class="legend">Grade: und(32,33,34) caixa(1/32,2/33,3/34)</legend>
			<p class="button-height inline-label">
				<label for="section_id" class="label">Tipo </label>
				<select name="type" class="select">
					<option value=""> Selecione o Tipo </option>
					<option value="unit"> Unidade </option>
					<option value="kit"> Kit </option>
				</select>
			</p>
			<p class="button-height inline-label">
				<label for="name" class="label"> Categoria <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="">
			</p>
			<p class="button-height inline-label">
				<label for="label" class="label">Grade <span class="red">*</span></label>
				<textarea name="label" class="input full-width" cols="10" rows="2"></textarea>
			</p>
			<p class="button-height align-right">
				<span class="button-group">
					@can('category-grids-create')
						<button id="btn-modal" onclick="formGridCategory('create', 'category-grids', 'aguarde', 'Salvar')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				</span>
			</p>			

		</fieldset>
	</form>
</div>