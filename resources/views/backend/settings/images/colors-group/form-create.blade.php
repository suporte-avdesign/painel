<div id="modal-color-grup">
	<form id="form-color-grup" method="POST" action="{{route('grupo-cores.store')}}" onsubmit="return false">
		@csrf
		<fieldset class="fieldset">
			<p class="button-height inline-label">
				<label for="code" class="label">Selecione a Cor<span class="red">*</span></label>
				<input type="color" name="code" style="width:40px;height:40px;background-color:#ffffff" value="">
			</p>
			<p class="button-height inline-label">
				<label for="name" class="label"> Nome <span class="red">*</span></label>
				<input type="text" name="name" class="input full-width" value="">
			</p>

			<p class="button-height inline-label">
				<label for="order" class="label">order / Status</label>
				<span class="number input margin-right">
					<button type="button" class="button number-down">-</button>
					<input type="text" name="order" value="" class="input order" size="2">
					<button type="button" class="button number-up">+</button>
				</span>
				<span class="button-group">
					<label for="status-1" class="button blue-active">
						<input type="radio" name="status" id="status-1" value="Ativo" checked>
						Ativo
					</label>
					<label for="status-0" class="button red-active">
						<input type="radio" name="status" id="status-0" value="Inativo">
						Inativo
					</label>
				</span>
			</p>
			<p class="button-height align-center">
				<span class="button-group">
					<button onclick="fechaModal()" class="button"> Cancelar </button>
					@can('config-color-grup-delete')
						<button id="btn-modal" onclick="formColorGrup('create', 'color-grup','Aguarde', 'Salvar')" class="button blue-gradient">
							<span class="icon-publish"></span> Salvar
						</button>
					@endcan
				</span>
			</p>
		</fieldset>
	</form>
</div>