<div id="modal-section-grids">
	<form id="form-section-grids" method="POST" action="{{route('grids-section.update', ['id' => $id, 'grid' => $data->id])}}" onsubmit="return false">
		@method("PUT")
		@csrf
		<fieldset class="fieldset">
			<legend class="legend">Grade: und(32,33,34) caixa(1/32,2/33,3/34)</legend>
			<p class="button-height inline-label">
				<label for="section_id" class="label">Tipo </label>
				<select name="type" class="select">
					<option value=""> Selecione o Tipo </option>
					<option value="unit"@if($data->type == 'unit') selected @endif> Unidade </option>
					<option value="kit"@if($data->type == 'kit') selected @endif> Kit </option>
				</select>
			</p>
			<p class="button-height inline-label">
				<label for="name" class="label"> Nome <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name}}">
			</p>
			<p class="button-height inline-label">
				<label for="label" class="label">Grade <span class="red">*</span></label>
				<textarea name="label" class="input full-width" cols="10" rows="2">{{$data->label}}</textarea>
			</p>
			<p class="button-height align-right">
				<span class="button-group">
					@can('section-grids-update')
						<button id="btn-modal" onclick="formGridSection('update', 'section-grids', 'aguarde', 'Alterar')" class="button blue-gradient"> 
						<span class="icon-redo"></span> Alterar 
						</button>
					@endcan
				</span>
			</p>			
		</fieldset>
	</form>
</div>