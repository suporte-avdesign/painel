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




