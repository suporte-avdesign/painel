<div id="modal-orders">
	<form id="form-orders" method="POST" action="{{route('pedidos.update', $data->id)}}" onsubmit="return false">
		@method("PUT")
		@csrf
		<fieldset class="fieldset">
			<legend class="legend blue-bg">Vendedor: {{$data->user->admin}}</legend>
			<p class="button-height inline-label">
				<label for="user_id" class="label"> Código Cliente <span class="red">*</span></label>
				<input type="text" name="user_id" class="input full-width" value="{{$data->user_id}}">
			</p>
			<p class="button-height inline-label">
				<label for="config_status_payment_id" class="label">Status <span class="red">*</span></label>
				<select name="config_status_payment_id" class="select">
					@foreach($status as $keys => $vals)
						<option value="{{$keys}}" @if($data->config_status_payment_id == $keys) selected @endif> {{$vals}} </option>
					@endforeach
				</select>
			</p>
			<p class="button-height inline-label">
				<label for="config_form_payment_id" class="label">Pagamento <span class="red">*</span></label>
				<select name="config_form_payment_id" class="select">
					@foreach($forms as $keyf => $valf)
						<option value="{{$keyf}}" @if($data->config_form_payment_id == $keyf) selected @endif> {{$valf}} </option>
					@endforeach
				</select>
			</p>
			<p class="button-height inline-label">
				<label for="freight" class="label"> Frete </label>
				<input type="text" style="width:80px" name="freight" class="input full-width" value="{{$data->freight}}" onKeyDown="javascript: return maskValor(this,event,8,2);" maxlength="8">
			</p>
			<p class="button-height inline-label">
				<label for="discount" class="label"> Desconto </label>
				<input type="text" style="width:80px" name="discount" class="input full-width" value="{{$data->discount}}" onKeyDown="javascript: return maskValor(this,event,8,2);" maxlength="8">
			</p>
			<p class="button-height inline-label">
				<label for="tax" class="label"> Taxa </label>
				<input type="text" style="width:80px" name="tax" class="input full-width" value="{{$data->tax}}" onKeyDown="javascript: return maskValor(this,event,8,2);" maxlength="8">
			</p>
			@if($configFreight->weight == 1)
				<p class="button-height inline-label">
					<label for="weight" class="label"> Peso </label>
					<input type="text" style="width:80px" name="weight" class="input small-margin-right" value="{{$data->weight}}" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
					<span class="info-spot on-left">
						<span class="icon-info-round"></span>
						<span class="info-bubble">Gramas</span>
					</span>
				</p>
			@endif
			@if($configFreight->width == 1)
				<p class="button-height inline-label">
					<label for="width" class="label"> Largura </label>
					<input type="text" style="width:80px" name="width" class="input small-margin-right" value="{{$data->width}}" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
					<span class="info-spot on-left">
						<span class="icon-info-round"></span>
						<span class="info-bubble">Centímetro</span>
					</span>
				</p>
			@endif
			@if($configFreight->height == 1)
				<p class="button-height inline-label">
					<label for="height" class="label"> Altura </label>
					<input type="text" style="width:80px" name="height" class="input small-margin-right" value="{{$data->height}}" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
					<span class="info-spot on-left">
						<span class="icon-info-round"></span>
						<span class="info-bubble">Centímetro</span>
					</span>
				</p>
			@endif
			@if($configFreight->length == 1)
				<p class="button-height inline-label">
					<label for="length" class="label"> Comprimento</label>
					<input type="text" style="width:80px" name="length" class="input small-margin-right" value="{{$data->length}}" onKeyDown="javascript: return maskValor(this,event,8);" maxlength="8">
					<span class="info-spot on-left">
						<span class="icon-info-round"></span>
						<span class="info-bubble">Centímetro</span>
					</span>
				</p>
			@endif

		</fieldset>

		<p class="button-height align-center">
			<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				@can('orders-update')
					<button id="btn-modal" onclick="formOrders('update', 'orders')" class="button icon-publish blue-gradient"> Alterar </button>
				@endcan
			</span>
		</p>		
	</form>
</div>
