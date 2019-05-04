<div id="modal-unit-measures">
	@if(isset($data))
		<form id="form-unit-measures" method="POST" action="{{route('unidades.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-unit-measures" method="POST" action="{{route('unidades.store')}}" onsubmit="return false">
	@endif	
		{{csrf_field()}}

		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="unit" class="label"> Unidade<span class="red">*</span></label>
				<span class="number input">
					<button type="button" class="button number-down">-</button>
						<input type="text" id="unit" name="unit" value="{{$data->unit or old('unit')}}" size="4" class="input-unstyled" data-number-options='{"min":0,"max":100,"increment":0.5,"shiftIncrement":5,"precision":0.25}'>
					<button type="button" class="button number-up">+</button>
				</span>
			</p>
			<p class="button-height inline-label">
				<label for="name" class="label"> Nome <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name or old('name')}}">
			</p>
			<p class="button-height inline-label">
				<label for="order" class="label">Ordem / Status</label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order or old('order')}}" class="input-unstyled order" size="2">
					<button type="button" class="button number-up">+</button>
				</span>
				<span class="button-group">
					<label for="status-1" class="button blue-active">
					@if(isset($data))
						<input type="radio" name="status" id="status-1" value="Ativo" {{{ $data->status == 'Ativo' ? 'checked' : '' }}}>
					@else
						<input type="radio" name="status" id="status-1" value="Ativo" checked>
					@endif
						Ativo
					</label>
					<label for="status-0" class="button red-active">
					@if(isset($data))
						<input type="radio" name="status" id="status-0" value="Inativo" {{{ $data->status == 'Inativo' ? 'checked' : '' }}}>
						Inativo
					@else
						<input type="radio" name="status" id="status-0" value="Inativo">
						Inativo
					@endif	
					</label>
				</span>
			</p>
			<p class="button-height align-center">
				<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>

				@if(isset($data))
					@can('config-unit-measure-update')
						<button id="btn-modal" onclick="formUnitMeasure('update')" class="button icon-	outbox blue-gradient"> 
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				@else
					@can('config-unit-measure-create')
						<button id="btn-modal" onclick="formUnitMeasure('create')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				@endif
				</span>
			</p>
		</fieldset>
	</form>
</div>
