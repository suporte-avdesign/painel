<div id="modal-profile-clients">
	@if(isset($data))
		<form id="form-profile-clients" method="POST" action="{{route('perfil-cliente.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-profile-clients" method="POST" action="{{route('perfil-cliente.store')}}" onsubmit="return false">
	@endif	
		{{csrf_field()}}

		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="profile" class="label"> Perfil <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name or old('profile')}}">
			</p>
			<p class="button-height inline-label">
				<label for="percent_card" class="label"> Parcelado <span class="red">*</span></label>
				<span class="number input">
					<button type="button" class="button number-down">-</button>
						<input type="text" id="percent_card" name="percent_card" value="{{$data->percent_card or old('percent_card')}}" size="4" class="input-unstyled" data-number-options='{"min":0,"max":100,"increment":0.5,"shiftIncrement":5,"precision":0.25}'>
					<button type="button" class="button number-up">+</button>
				</span>
				<label for="label-percent_card" class="button blue-gradient">
					<i class="fa fa-percent" aria-hidden="true"></i>
				</label>
			</p>
			<p class="button-height inline-label">
				<label for="percent_cash" class="label"> À Vista <span class="red">*</span></label>
				<span class="number input">
					<button type="button" class="button number-down">-</button>
						<input type="text" id="percent_cash" name="percent_cash" value="{{$data->percent_cash or old('percent_cash')}}" size="4" class="input-unstyled" data-number-options='{"min":0,"max":100,"increment":0.5,"shiftIncrement":5,"precision":0.25}'>
					<button type="button" class="button number-up">+</button>
				</span>
				<label for="label-percent_cash" class="button blue-gradient">
					<i class="fa fa-percent" aria-hidden="true"></i>
				</label>
			</p>
			<p class="button-height inline-label">
				<label for="sum" class="label">Calcular para:</label>
				<span class="button-group">
					<label for="sum-1" class="button blue-active">
					@if(isset($data))
						<input type="radio" name="sum" id="sum-1" value="+" {{{ $data->sum == '+' ? 'checked' : '' }}}>
					@else
						<input type="radio" name="sum" id="sum-1" value="+" checked>
					@endif
						Mais
					</label>
					<label for="sum-0" class="button red-active">
					@if(isset($data))
						<input type="radio" name="sum" id="sum-0" value="-" {{{ $data->sum == '-' ? 'checked' : '' }}}>
					@else
						<input type="radio" name="sum" id="sum-0" value="-">
					@endif	
						Menos
					</label>
				</span>
			</p>

			<p class="button-height inline-label">
				<label for="order" class="label">Ordem / Status</label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order or old('order')}}" class="input-unstyled order" size="3">
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
					@can('config-profile-client-update')
						<button id="btn-modal" onclick="formProfileClient('update')" class="button icon-	outbox blue-gradient"> 
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				@else
					@can('config-profile-client-create')
						<button id="btn-modal" onclick="formProfileClient('create')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar 
						</button>
					@endcan
				@endif
				</span>
			</p>
		</fieldset>
	</form>
</div>
