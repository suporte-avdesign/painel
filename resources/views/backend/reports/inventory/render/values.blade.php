<span class="black">{{constLang('cost')}}:</span> {{$collect->cost_total}}<br>
@if($collect->price_profile != null)
    <span class="icon-user black">{{constLang('profile')}}:</span> {{$collect->price_profile}}<br>
@else
    <span class="icon-user black">{{constLang('profile')}}:</span> {{$collect->profile_name}}<br>
@endif
<span class="black">{{constLang('value')}}:</span> {{$collect->price_unit}}<br>
<span class="black">{{constLang('total')}}:</span> {{$collect->price_total}}
