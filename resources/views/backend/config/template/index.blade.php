<div class="block large-margin-bottom">
	<div class="block-title">
		<h3><span class="icon icon-publish"></span> {{$config['title_index']}}</h3>
		@can('config-site-create')
			<div class="button-group absolute-right compact">
				<button onclick="abreModal('{{$config['title_page']}}', '{{route('page-site.create')}}', 'page', 2, true, 240, 340)"
						title="{{$config['title_page']}}"
						class="button icon-plus-round with-tooltip anthracite-gradient">{{$config['text_page']}}
				</button>
				<button onclick="abreModal('{{$config['title_model']}}', '{{route('template-site.create')}}', 'template', 2, true, 240, 340)"
						title="{{$config['title_model']}}"
						class="button icon-plus-round with-tooltip anthracite-gradient">{{$config['text_model']}}
				</button>
			</div>
		@endcan
	</div>

		<div class="with-padding" id="load-template">

			@foreach($pages as $page)
				<h4 class="grey underline">{{$page->name}}</h4>
				<p class="button-height">
					<span class="button-group">
						@foreach($page->modules as $mod)
							@if ($mod->tmp == 1)
								<button class="button margin-top">{{$mod->name}}<span class="count blue-gradient">{{$mod->tmp}}</span></button>
							@elseif ($mod->tmp == 2)
								<button class="button margin-top">{{$mod->name}}<span class="count orange-gradient">{{$mod->tmp}}</span></button>
							@elseif ($mod->tmp == 3)
								<button class="button margin-top">{{$mod->name}}<span class="count green-gradient">{{$mod->tmp}}</span></button>
							@else
								<button class="button margin-top">{{$mod->name}}<span class="count grey-gradient">{{$mod->tmp}}</span></button>
							@endif
						@endforeach
					</span>
				</p>
			@endforeach

		</div>
</div>
<script src="{{url('assets/backend/scripts/settings/template.js')}}?{{time()}}"></script>

