<div id="modal-color-grup">
@if(isset($data))
	<form id="form-color-grup" method="POST" action="{{route('grupo-cores.update', $data->id)}}" onsubmit="return false">
		<input name="_method" type="hidden" value="PUT">
@else
	<form id="form-color-grup" method="POST" action="{{route('grupo-cores.store')}}" onsubmit="return false">
@endif	
	{{csrf_field()}}
	<fieldset class="fieldset">
		<p class="button-height inline-label">
			<label for="code" class="label">Selecione a Cor<span class="red">*</span></label>
			@if(isset($data))	
				<input type="color" name="code" style="width:40px;height:40px;background-color:{{$data->code}}" value="{{$data->code}}">
			@else
				<input type="color" name="code" style="width:40px;height:40px;background-color:#ffffff" value="">
			@endif
		</p>
		<p class="button-height inline-label">
			<label for="name" class="label"> Nome <span class="red">*</span></label>
			<input type="text" name="name" class="input full-width" value="{{$data->name or old('name')}}">
		</p>

		<p class="button-height inline-label">
			<label for="order" class="label">order / Status</label>
			<span class="number input margin-right">
				<button type="button" class="button number-down">-</button>
				<input type="text" name="order" value="{{$data->order or old('order')}}" class="input order" size="2">
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
				@can('config-color-grup-update')
					<button id="btn-modal" onclick="formColorGrup('update', 'color-grup','Aguarde', 'Alterar')" class="button icon-	outbox blue-gradient"> 
					<span class="icon-publish"></span> Alterar 
					</button>
				@endcan
			@else
				@can('config-color-grup-delete')
					<button id="btn-modal" onclick="formColorGrup('create', 'color-grup','Aguarde', 'Salvar')" class="button blue-gradient">
						<span class="icon-publish"></span> Salvar 
					</button>
				@endcan
			@endif
			</span>
		</p>
	</fieldset>
</form>
</div>