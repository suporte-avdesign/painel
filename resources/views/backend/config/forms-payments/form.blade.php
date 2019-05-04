<div id="modal-payments">
	@if(isset($data))
		<form id="form-payment" method="POST" action="{{route('forma-pagamentos.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-payment" method="POST" action="{{route('forma-pagamentos.store')}}" onsubmit="return false">
	@endif	
		{{csrf_field()}}
		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="label" class="label">Forma <span class="red">*</span></label>
				<input type="text" name="label" class="input full-width" value="{{$data->label or old('label')}}" >
			</p>

			<p class="button-height inline-label">
				<label for="description" class="label">Descrição <span class="red">*</span></label>
				<textarea name="description" class="input full-width" cols="30" rows="3">{{$data->description or old('description')}}</textarea>
			</p>

			<p class="button-height inline-label">
				<label for="order" class="label">Ordem / Status</label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order or old('order')}}" class="input-unstyled order" size="2">
					<button type="button" class="button number-up">+</button>
				</span>
				<span class="button-group">
					<label for="active-1" class="button blue-active">
						<input type="radio" name="active" id="active-1" value="1" @if(isset($data) && $data->active == 1) checked @endif>
						Ativo
					</label>
					<label for="active-0" class="button red-active">
						<input type="radio" name="active" id="active-0" value="0" @if(isset($data) && $data->active == 0) checked @endif>
						Inativo
					</label>
				</span>
			</p>
			<p class="button-height align-center">
				<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>

				@if(isset($data))
					@can('config-form-payment-update')
						<button id="btn-modal" onclick="formPayments('update', 'payment','{{route('forma-pagamentos.show', 1)}}')" class="button icon-	outbox blue-gradient">
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				@else
					@can('config-form-payment-create')
						<button id="btn-modal" onclick="formPayments('create', 'payment','{{route('forma-pagamentos.show', 1)}}')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				@endif
				</span>
			</p>
		</fieldset>
	</form>
</div>
