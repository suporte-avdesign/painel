<div id="modal-shippings">
	<form id="form-shippings" method="POST" action="{{route('metodos.update', $data->id)}}" onsubmit="return false">
		@method("PUT")
		@csrf
		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="name" class="label">Método <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="{{$data->name}}" >
			</p>

			<p class="button-height inline-label">
				<label for="description" class="label">Descrição <span class="red">*</span></label>
				<textarea name="description" class="input full-width" cols="30" rows="3">{{$data->description}}</textarea>
			</p>

			<p class="hide">
				<input type="hidden" name="url_metodo">
			</p>

			<p class="button-height inline-label">
				<label for="order" class="label">Ordem / Status</label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="{{$data->order}}" class="input-unstyled order" size="2">
					<button type="button" class="button number-up">+</button>
				</span>
				<span class="button-group">
					<label for="status-1" class="button blue-active">
						<input type="radio" name="status" id="status-1" value="Ativo" @if($data->status == 'Ativo') checked @endif>
						Ativo
					</label>
					<label for="status-0" class="button red-active">
						<input type="radio" name="status" id="status-0" value="Inativo" @if($data->status == 'Inativo') checked @endif>
						Inativo
					</label>
				</span>
			</p>
			<p class="button-height align-center">
				<span class="button-group">
					<button onclick="fechaModal()" class="button"> Cancelar </button>
					@can('config-shipping-update')
						<button id="btn-modal" onclick="formShipping('update', 'shippings','{{route('metodos.show', 1)}}')" class="button icon-	outbox blue-gradient"> 
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				</span>
			</p>
		</fieldset>
	</form>
</div>
