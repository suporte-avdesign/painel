<div id="modal-status-payments">
	@if(isset($data))
		<form id="form-status-payments" method="POST" action="{{route('status-pagamentos.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-status-payments" method="POST" action="{{route('status-pagamentos.store')}}" onsubmit="return false">
	@endif	
		{{csrf_field()}}
		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="gateway" class="label">Gateway <span class="red">*</span></label>
				<input type="text" name="gateway" class="input full-width" value="{{$data->gateway or old('gateway')}}" >
			</p>
			<p class="button-height inline-label">
				<label for="label" class="label">Nome <span class="red">*</span></label>
				<input type="text" name="label" class="input full-width" value="{{$data->label or old('label')}}" >
			</p>

			<p class="button-height inline-label">
				<label for="description" class="label">Descrição <span class="red">*</span></label>
				<textarea name="description" class="input full-width" cols="30" rows="3">{{$data->description or old('description')}}</textarea>
			</p>

			<p class="button-height inline-label">
				<label for="description" class="label">Ord|Tipo|Cod <span class="red">*</span></label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order or old('order')}}" class="input-unstyled order" size="2">
					<button type="button" class="button number-up">+</button>
				</span>
				<span class="button-group">
					<label for="type-1" class="button green-active">
						<input type="radio" name="type" id="type-1" value="C" @if(isset($data) && $data->type == 'C') checked @endif>
						C
					</label>
					<label for="type-2" class="button green-active">
						<input type="radio" name="type" id="type-2" value="S" @if(isset($data) && $data->type == 'S') checked @endif>
						S
					</label>
				</span>
				<span class="number input margin-right">
					<input type="text" name="status" value="{{$data->status or old('status')}}" class="input-unstyled order" size="3">
				</span>
			</p>

			<p class="button-height inline-label">
				<label for="status" class="label"> Status</label>
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
					@can('config-status-payments-update')
						<button id="btn-modal" onclick="formStatusPayments('update', 'status-payments','{{route('status-pagamentos.show', 1)}}')" class="button icon-	outbox blue-gradient">
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				@else
					@can('config-status-payments-create')
						<button id="btn-modal" onclick="formStatusPayments('create', 'status-payments','{{route('status-pagamentos.show', 1)}}')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				@endif
				</span>
			</p>
		</fieldset>
	</form>
</div>
