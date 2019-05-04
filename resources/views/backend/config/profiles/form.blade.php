<div id="modal-profiles">
@if(isset($data))
	<form id="form-profiles" method="POST" action="{{route('perfis.update', $data->id)}}" onsubmit="return false">
		<input name="_method" type="hidden" value="PUT">
@else
	<form id="form-profiles" method="POST" action="{{route('perfis.store')}}" onsubmit="return false">
@endif	
	{{csrf_field()}}
	<fieldset class="fieldset">
		<p class="button-height inline-label">
			<label for="name" class="label"> Perfil <span class="red">*</span></label>
			<input type="text" name="name" class="input full-width" value="{{$data->name or old('name')}}">
		</p>

		<p class="button-height inline-label">
			<label for="label" class="label"> Descrição <span class="red">*</span></label>
			<textarea name="label" class="input full-width autoexpanding">{{$data->label or old('label')}}</textarea>
		</p>
		<p class="button-height align-center">
			<span class="button-group">
			<button onclick="fechaModal()" class="button"> Cancelar </button>

			@if(isset($data))
				<button id="btn-modal" onclick="formProfile('update')" class="button icon-	outbox blue-gradient"> 
				<span class="icon-outbox"></span> Alterar 
				</button>
			@else
				<button id="btn-modal" onclick="formProfile('create')" class="button blue-gradient">
					<span class="icon-outbox"></span> Salvar 
				</button>
			@endif
			</span>
		</p>
	</fieldset>
</form>
</div>


