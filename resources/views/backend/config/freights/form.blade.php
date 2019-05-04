<div class="block-title silver-gradient">
	<h3>
		<i class="fa fa-cog" aria-hidden="true"></i>
		<strong> {{$title}} </strong>
	</h3>
</div>
<div class="silver-gradient">
	<div class="with-padding">
		<form id="form-config-products" method="POST" action="{{route('config.freight.update', $data->id)}}" onsubmit="return false">
			<div class="columns">
				<div class="six-columns twelve-columns-tablet">
					<input name="_method" type="hidden" value="PUT">
					{{csrf_field()}}
					<fieldset class="fieldset">
					    <legend class="legend">Padrão dos correios</legend>
						<p class="button-height inline-label">
							<label for="default" class="label">Padrão <span class="red">*</span></label>
							<select name="default" id="default" class="select">
								<option value="1" {{{ $data->default == 1 ? 'selected' : '' }}}> Ativo </option>
								<option value="0" {{{ $data->default == 0 ? 'selected' : '' }}}> Inativo </option>
							</select>
						</p>
						<p class="button-height inline-label">
							<label for="weight" class="label">Peso <span class="red">*</span></label>
							<span class="button-group">
								<label for="radio-0" class="button green-active">
									<input type="radio" name="weight" id="radio-0" value="1" {{{ $data->weight == 1 ? 'checked' : '' }}}>
									Sim
								</label>
								<label for="radio-1" class="button red-active" >
									<input type="radio" name="weight" id="radio-1" value="0" {{{ $data->weight == 0 ? 'checked' : '' }}}>
									Não
								</label>
							</span>
						</p>
						<p class="button-height inline-label">
							<label for="width" class="label">Largura <span class="red">*</span></label>
							<span class="button-group">
								<label for="radio-2" class="button green-active">
									<input type="radio" name="width" id="radio-2" value="1" {{{ $data->width == 1 ? 'checked' : '' }}}>
									Sim
								</label>
								<label for="radio-3" class="button red-active" >
									<input type="radio" name="width" id="radio-3" value="0" {{{ $data->width == 0 ? 'checked' : '' }}}>
									Não
								</label>
							</span>
						</p>
						<p class="button-height inline-label">
							<label for="altura" class="label">Altura <span class="red">*</span></label>
							<span class="button-group">
								<label for="radio-4" class="button green-active">
									<input type="radio" name="height" id="radio-4" value="1" {{{ $data->height == 1 ? 'checked' : '' }}}>
									Sim
								</label>
								<label for="radio-5" class="button red-active" >
									<input type="radio" name="height" id="radio-5" value="0" {{{ $data->height == 0 ? 'checked' : '' }}}>
									Não
								</label>
							</span>
						</p>
						<p class="button-height inline-label">
							<label for="length" class="label">Comprimento <span class="red">*</span></label>
							<span class="button-group">
								<label for="radio-6" class="button green-active">
									<input  type="radio" name="length" id="radio-6" value="1" {{{ $data->length == 1 ? 'checked' : '' }}}>
									Sim
								</label>
								<label for="radio-7" class="button red-active" >
									<input type="radio" name="length" id="radio-7" value="0" {{{ $data->length == 0 ? 'checked' : '' }}}>
									Não
								</label>
							</span>
						</p>
						@can('config-freight-update')
							<p class="button-height inline-label">
								<button onclick="postFormJson($(this.form).attr('id'));" class="button icon-publish blue-gradient"> Salvar </button>
							</p>
						@endcan
					</fieldset>
				</div>
				<div class="six-columns twelve-columns-tablet">
					<h4 class="green underline">Observações</h4>
					<ol>
						<li>Padrão Ativo: Os campos serão obrigatórios.</li>
						<li>Padrão Inativo: O frete não sera obrigatório.</li>
						<li>Sim: Os campos serão obrigatórios.</li>
						<li>Não: Os campos não serão obrigatórios.</li>
					</ol>
				</div>
			</div>
		</form>
	</div>
</div>