<div class="standard-tabs margin-bottom" id="add-tabs">
	<ul class="tabs new-product">
		<li id="show-product" class="active"><a href="#tab-product">Dados do Produto</a></li>
		<li id="show-colors" class="disabled"><a href="#tab-colors">Imagens</a></li>
		@if($configProduct->positions == 1)
			<li id="show-positions" class="disabled"><a href="#tab-positions">Posições</a></li>
		@endif	
	</ul>
	<div class="tabs-content">

		<div id="tab-product" class="with-padding">
            <!-- Form: product create -->
            @include('backend.products2.modal.forms.create.product')
		</div>

		<div id="tab-colors" class="with-padding">
			@if($configProduct->mini_colors == 'hexa')
				@include('backend.products2.modal.modules.create.hexa')
			@endif
		</div>
		
		@if($configProduct->positions == 1)
			<div id="tab-positions" class="with-padding">
	            <!-- Form: posições -->
	            @include('backend.products2.modal.forms.create.positions')
			</div>
		@endif

	</div>
</div>