@foreach ($grids as $value)
    @php 
        ($stock == 1 ? $text = '/Estoque' : $text = ''); 
    @endphp
    <h4 class="green underline">Grade{{$text}}: {{$value->name}}</h4>
    <div class="columns">        
        @php
            $label = explode(",", $value->label);
        @endphp
        <span>    
            <input type="radio" id="opc-{{$value->id}}" name="opc[]" value="{{$value->label}}" class="tick checkbox mid-margin-left">
        </span>

        @foreach ($label as $val)
            <label class="button blue-gradient">{{$val}}</label>
        @endforeach
        <span id="tick-{{$value->id}}" style="display:none">&nbsp;&nbsp;<span class="icon-size2 icon-tick icon-green"></span></span>
    </div>
@endforeach
    <input type="hidden" id="grid" name="grids[grid]" value="">
    @if($stock == 1)
        <p class="button-height margin-top">
            <span class="input">
                <label class="button green-gradient">Estoque</label>
                <input type="text" id="entry" name="grids[entry]" class="input-unstyled" value="" placeholder="Qtd" style="width: 30px;">
            </span>
        </p>
    @endif

<script>
$('.tick').on('change', function() {
    var str   = $(this).attr('id'),
        res   = str.split("-"),
        id    = res[1],
        opc   = $("#opc-"+id).val(),
        grid  = $('#grid').val(opc);
});
</script>