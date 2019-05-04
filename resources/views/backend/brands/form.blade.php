<div id="modal-brands">
@if(isset($data))
	<form id="form-brands" method="POST" action="{{route('marcas.update', $data->id)}}" onsubmit="return false">
		<input name="_method" type="hidden" value="PUT">
@else
	<form id="form-brands" method="POST" action="{{route('marcas.store')}}" onsubmit="return false">
@endif	
	{{csrf_field()}}
		<fieldset class="fieldset">
			<legend class="legend">Informações da Marca</legend>
			<p class="button-height inline-label">
				<label for="name" class="label"> Nome <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name or old('name')}}">
			</p>
			<p class="button-height inline-label">
				<label for="tags" class="label"> Tags </label>
				<input type="text" name="tags" class="input full-width" value="{{$data->tags or old('tags')}}">
			</p>

			@if($configModel->description == 1)
				<p class="button-height inline-label">
					<label for="description" class="label">Descrição <span class="red">*</span></label>
					<textarea name="description" class="input full-width" cols="50" rows="2">{{$data->description or old('description')}}</textarea>
				</p>
			@endif


			<p class="button-height inline-label">
				<label for="status" class="label">Ordem / Status </label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order or old('order')}}" size="2" class="input-unstyled order">
					<button type="button" class="button number-up">+</button>
				</span>

				<span class="button-group">
					<label for="status-1" class="button blue-active">
					@if(isset($data))
						<input type="radio" name="status" id="status-1" value="Ativo" {{{ $data->status == 'Ativo' ? 'checked' : '' }}}>
					@else
						<input type="radio" name="status" id="status-1" value="Ativo" checked="">
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

			@if($configModel->img_logo == 1)
				<p class="button-height inline-label">
					<label for="status_logo" class="label">Status Logo</label>
					<span class="button-group">
						<label for="status_logo-1" class="button blue-active">
						@if(isset($data))
							<input type="radio" name="status_logo" id="status_logo-1" value="Ativo" {{{ $data->status_logo == 'Ativo' ? 'checked' : '' }}}>
						@else
							<input type="radio" name="status_logo" id="status_logo-1" value="Ativo" checked="">
						@endif
							Ativo
						</label>
						<label for="status_logo-0" class="button red-active">
						@if(isset($data))
							<input type="radio" name="status_logo" id="status_logo-0" value="Inativo" {{{ $data->status_logo == 'Inativo' ? 'checked' : '' }}}>
						@else
							<input type="radio" name="status_logo" id="status_logo-0" value="Inativo">
						@endif	
							Inativo
						</label>
					</span>
				</p>
			@endif

			@if($configModel->img_banner == 1)
				<p class="button-height inline-label">
					<label for="status_banner" class="label">Status Banner </label>
					<span class="button-group">
						<label for="status_banner-1" class="button blue-active">
						@if(isset($data))
							<input type="radio" name="status_banner" id="status_banner-1" value="Ativo" {{{ $data->status_banner == 'Ativo' ? 'checked' : '' }}}>
						@else
							<input type="radio" name="status_banner" id="status_banner-1" value="Ativo" checked="">
						@endif
							Ativo
						</label>
						<label for="status_banner-0" class="button red-active">
						@if(isset($data))
							<input type="radio" name="status_banner" id="status_banner-0" value="Inativo" {{{ $data->status_banner == 'Inativo' ? 'checked' : '' }}}>
						@else
							<input type="radio" name="status_banner" id="status_banner-0" value="Inativo">
						@endif	
							Inativo
						</label>
					</span>
				</p>
			@endif
		</fieldset>
			<!-- Informações-->

			@if($configModel->info == 1)
				<fieldset class="fieldset">
					<legend class="legend">Informações do Fabricante</legend>
					<p class="button-height inline-label">
						<label for="email" class="label"> Email </label>
						<input type="email" name="email" class="input full-width" value="{{$data->email or old('email')}}">
					</p>
					<p class="button-height inline-label">
						<label for="phone" class="label"> Telefone </label>
						<input type="text" id="phone" name="phone" class="input full-width" value="{{$data->phone or old('phone')}}">
					</p>
					<p class="button-height inline-label">
						<label for="contact" class="label"> Nome contato </label>
						<input type="text" id="contact" name="contact" class="input full-width" value="{{$data->contact or old('contact')}}">
					</p>
					<p class="button-height inline-label">
						<label for="address" class="label"> Endereço </label>
						<input type="text" name="address" class="input full-width" value="{{$data->address or old('address')}}">
					</p>
					<p class="button-height inline-label">
						<label for="number" class="label"> Número </label>
						<input type="text" name="number" class="input full-width" value="{{$data->number or old('number')}}">
					</p>
					<p class="button-height inline-label">
						<label for="district" class="label"> Bairro </label>
						<input type="text" name="district" class="input full-width" value="{{$data->district or old('district')}}">
					</p>
					<p class="button-height inline-label">
						<label for="city" class="label"> Cidade </label>
						<input type="text" name="city" class="input full-width" value="{{$data->city or old('city')}}">
					</p>
					<p class="button-height inline-label">
						<label for="state" class="label">Estado </label>
						<select name="state" class="select">
							<option value=""> Selecione o Estado </option>
							@foreach($options as $key => $val)
								<option value="{{$key}}" 
								@if(isset($data) && $data->state == $val) selected @endif> {{$val}} </option>
							@endforeach
						</select>
					</p>
					<p class="button-height inline-label">
						<label for="zip_code" class="label"> CEP </label>
						<input type="text" id="zip_code" name="zip_code" class="input full-width" value="{{$data->zip_code or old('zip_code')}}">
					</p>
				</fieldset>
			@endif

			<p class="button-height align-center">
				<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				@if(isset($data))
					@can('brand-update')
						<button id="btn-modal" onclick="formBrand('update')" class="button icon-publish blue-gradient"> Alterar </button>
					@endcan
				@else
					@can('brand-create')
						<button id="btn-modal" onclick="formBrand('create')" class="button icon-publish blue-gradient"> Salvar </button>
					@endcan
				@endif
				</span>
			</p>
		
	</form>
</div>
<!-- Mask -->
<script src="{{url('assets/backend/js/libs/Mask/jquery.maskedinput.js')}}"></script>

<script>
$( document ).ready(function() {
    $("#phone").mask("(99) 9999-9999?9");
    $("#zip_code").mask("99999-999"); 
});
</script>