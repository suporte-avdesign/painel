<div id="modal-shippings">
	@if(isset($data))
		<form id="form-shippings" method="POST" action="{{route('metodos.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-shippings" method="POST" action="{{route('metodos.store')}}" onsubmit="return false">
	@endif	
		{{csrf_field()}}
		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="name" class="label">Método <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name or old('name')}}" >
			</p>

			<p class="button-height inline-label">
				<label for="description" class="label">Descrição <span class="red">*</span></label>
				<textarea name="description" class="input full-width" cols="30" rows="3">{{$data->description or old('description')}}</textarea>
			</p>

			<p class="hide">
				<input type="hidden" name="url_metodo">
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
					@else
						<input type="radio" name="status" id="status-0" value="Inativo">
					@endif	
						Inativo
					</label>
				</span>
			</p>
			<p class="button-height align-center">
				<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>

				@if(isset($data))
					@can('config-shipping-update')
						<button id="btn-modal" onclick="formShipping('update', 'shippings','{{route('metodos.show', 1)}}')" class="button icon-	outbox blue-gradient"> 
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				@else
					@can('config-shipping-create')
						<button id="btn-modal" onclick="formShipping('create', 'shippings','{{route('metodos.show', 1)}}')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				@endif
				</span>
			</p>
		</fieldset>
	</form>
</div>
