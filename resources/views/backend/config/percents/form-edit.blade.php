<div id="modal-percents">
	<form id="form-percents" method="POST" action="{{route('porcentagens.update', $data->id)}}" onsubmit="return false">
		@method("PUT")
		@csrf
		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="porcento" class="label"> Porcento<span class="red">*</span></label>
				<span class="number input">
					<button type="button" class="button number-down">-</button>
						<input type="text" id="percent" name="percent" value="{{$data->percent}}" size="4" class="input-unstyled" data-number-options='{"min":0,"max":100,"increment":0.5,"shiftIncrement":5,"precision":0.25}'>
					<button type="button" class="button number-up">+</button>
				</span>
				<label for="percent" class="button blue-gradient">
					<i class="fa fa-percent" aria-hidden="true"></i>
				</label>
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
					@can('config-percent-update')
						<button id="btn-modal" onclick="formPercent('update')" class="button icon-	outbox blue-gradient"> 
						<span class="icon-publish"></span> Alterar 
						</button>
					@endcan
				</span>
			</p>
		</fieldset>
	</form>
</div>
