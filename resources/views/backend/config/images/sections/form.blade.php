<div class="block-title silver-gradient">
	<h3>
		<i class="fa fa-cog" aria-hidden="true"></i>
		<strong> {{$title}} </strong>
	</h3>
</div>
<div class="silver-gradient">
	<div class="with-padding">
		<form id="form-config-section" method="POST" action="{{route('config.section.update', $data->id)}}" onsubmit="return false">
			<input name="_method" type="hidden" value="PUT">
			{{csrf_field()}}

			<fieldset class="fieldset">
				<legend class="legend">Padrões dos Formulários</legend>
				<p class="button-height inline-label">
					<label for="description" class="label">Descrição <span class="red">*</span></label>
					<span class="button-group">
						<label for="description-2" class="button green-active">
							<input type="radio" name="description" id="description-2" value="1" {{{ $data->description == 1 ? 'checked' : '' }}}>
							Sim
						</label>
						<label for="description-3" class="button green-active">
							<input type="radio" name="description" id="description-3" value="0" {{{ $data->description == 0 ? 'checked' : '' }}}>
							Não
						</label>
					</span>
				</p>
				<p class="button-height inline-label">
					<label for="grids" class="label">Grades <span class="red">*</span></label>
					<span class="button-group">
						<label for="grids-1" class="button green-active">
							<input type="radio" name="grids" id="grids-1" value="1" {{{ $data->grids == 1 ? 'checked' : '' }}}>
							Sim
						</label>
						<label for="grids-0" class="button green-active" >
							<input type="radio" name="grids" id="grids-0" value="0" {{{ $data->grids == 0 ? 'checked' : '' }}}>
							Não
						</label>
					</span>
				</p>
				<p class="button-height">
					<span class="input">
						<label for="pseudo-input-1" class="button blue-gradient">Tamanho Modal</label>
						<input type="number" name="width_modal" class="input-unstyled input-sep" placeholder="Largura" maxlength="3" value="{{$data->width_modal or old('width_logo')}}" style="width: 80px;">
						<input type="number" name="height_modal" class="input-unstyled" placeholder="Altura" maxlength="3" value="{{$data->height_modal or old('height_modal')}}" style="width: 80px;">
					</span>							
				</p>				
			</fieldset>

			<fieldset class="fieldset">
			    <legend class="legend">Padrão das imagens</legend>
				<p class="button-height inline-label">
					<label for="path" class="label">Pasta <span class="red">*</span></label>
					<input type="text" name="path" class="input full-width" value="{{$data->path}}">
				</p>
				<p class="button-height inline-label">
					<label for="img_default" class="label">Padrão <span class="red">*</span></label>
					<select name="img_default" id="img_padrao" class="select">
						<option value="B" {{{ $data->img_default == 'B' ? 'selected' : '' }}}> Banner </option>
						<option value="D" {{{ $data->img_default == 'D' ? 'selected' : '' }}}>Destaque </option>
					</select>
				</p>
				<p class="button-height inline-label">
					<label for="destaque" class="label">Destaque <span class="red">*</span></label>
					<span class="input">
						<select name="img_featured" class="select compact expandable-list" style="width: 100px">
							<option value="1" {{{ $data->img_featured == 1 ? 'selected' : '' }}}>Ativo</option>
							<option value="0" {{{ $data->img_featured == 0 ? 'selected' : '' }}}>Inativo</option>
						</select>
						<input type="number" name="width_featured" class="input-unstyled input-sep" placeholder="Largura" maxlength="3" value="{{$data->width_featured or old('width_featured')}}" style="width: 80px;">
						<input type="number" name="height_featured" class="input-unstyled" placeholder="Altura" maxlength="3" value="{{$data->height_featured or old('height_featured')}}" style="width: 80px;">
					</span>							
				</p>
				<p class="button-height inline-label">
					<label for="banner" class="label">Banner <span class="red">*</span></label>
					<span class="input">
						<select name="img_banner" class="select compact expandable-list" style="width: 100px">
							<option value="1" {{{ $data->img_banner == 1 ? 'selected' : '' }}}>Ativo</option>
							<option value="0" {{{ $data->img_banner == 0 ? 'selected' : '' }}}>Inativo</option>
						</select>
						<input type="number" name="width_banner" class="input-unstyled input-sep" placeholder="Largura" maxlength="4" value="{{$data->width_banner or old('width_banner')}}" style="width: 80px;">
						<input type="number" name="height_banner" class="input-unstyled" placeholder="Altura" maxlength="3" value="{{$data->height_banner or old('height_banner')}}" style="width: 80px;">
					</span>							
				</p>
					@can('config-section-update')
						<p class="button-height inline-label">
							<button onclick="postFormJson($(this.form).attr('id'));" class="button icon-publish blue-gradient"> Salvar</button>
						</p>
					@endcan
				</fieldset>
		</form>
	</div>
</div>