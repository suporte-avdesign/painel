<div id="modal-permissions">
@if(isset($data))
	<form id="form-permissions" method="POST" action="{{route('permissoes.update', $data->id)}}" onsubmit="return false">
		<input name="_method" type="hidden" value="PUT">
@else
	<form id="form-permissions" method="POST" action="{{route('permissoes.store')}}" onsubmit="return false">
@endif	
	{{csrf_field()}}
	<fieldset class="fieldset">
		<p class="button-height inline-label">
			<label for="model" class="label"> Modulo <span class="red">*</span></label>
            <select id="select-models" name="module_id" class="select">
            	<option value="">Selecione um</option>
                @foreach($options as $key => $val)
                    <option value="{{$key}}" 
                    @if(isset($data) && $data->module_id == $key) selected @endif> {{$val}} </option>
                @endforeach
            </select>
        </p>
		<p class="button-height inline-label">
			<label for="name" class="label"> Permissão <span class="red">*</span></label>
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
				<button id="btn-modal" onclick="formPermission('update')" class="button icon-	outbox blue-gradient"> 
				<span class="icon-outbox"></span> Alterar 
				</button>
			@else
				<button id="btn-modal" onclick="formPermission('create')" class="button blue-gradient">
					<span class="icon-outbox"></span> Salvar 
				</button>
			@endif
			</span>
		</p>
	</fieldset>
</form>
</div>


