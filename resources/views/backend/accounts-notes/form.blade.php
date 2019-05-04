<div id="modal-notes" xmlns="http://www.w3.org/1999/html">
	@if(isset($data))
		<form id="form-notes" method="POST" action="{{route('notes.update', ['id' => $data->id, 'user_id' => $data->user_id])}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
	@else
		<form id="form-notes" method="POST" action="{{route('notes.store', $user->id)}}" onsubmit="return false">
	@endif
			{{csrf_field()}}
		<fieldset class="fieldset">

			<p class="block-label button-height">
				<label for="label" class="label"> Observação <span class="red">*</span></label>
				<input type="text" name="notes[label]" id="label" class="input full-width" value="{{$data->label or old('notes.label')}}">
			</p>
			<p class="block-label button-height">
				<label for="label" class="label"> Descrição <span class="red">*</span></label>
				<textarea rows="5" name="notes[description]" id="description" class="input full-width">{{$data->description or old('notes.description')}}</textarea>
			</p>


		</fieldset>
		<p class="button-height align-center">
			<span class="button-group">
				<button onclick="fechaModal()" class="button"> Cancelar </button>
				@if(isset($data))
					@can('account-update')
						<button id="btn-modal" onclick="formNotes('update', '{{route('account-notes.refresh', $data->user_id)}}')" class="button icon-publish blue-gradient"> Alterar </button>
					@endcan
				@else
					@can('account-create')
						<button id="btn-modal" onclick="formNotes('create', '{{route('account-notes.refresh', $user->id)}}')" class="button icon-publish blue-gradient"> Alterar </button>
					@endcan
				@endif
			</span>
		</p>

	</form>
</div>
