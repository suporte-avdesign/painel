@foreach ($grids as $value)
    @php 
        ($stock == 1 ? $text = '/Estoque' : $text = ''); 
    @endphp
    <h4 class="green underline">
        <input type="checkbox" id="check-all" name="check-all" value="1" class="checkbox mid-margin-left">
        Grade{{$text}}: {{$value->name}}
    </h4>
    <div class="columns">        
        @php
            $label = explode(",", $value->label);
        @endphp
        @foreach ($label as $str)
            @php  $val = str_replace('/', '_', trim($str));   @endphp
            <p class="button-height">                    
                <span>    
                    <input type="checkbox" id="{{$val}}" name="grids[{{$val}}]" value="1" class="tick checkbox mid-margin-left">
                </span>
                <span class="input">
                    <label for="tam-{{$val}}" class="button blue-gradient">{{$str}}</label>
                    @if($stock == 1)
                        <input type="text" id="qty-{{$val}}" name="qty[]" class="input-unstyled" placeholder="Qtd" value="" autocomplete="off" style="width: 30px;">
                    @endif
                </span>
                <span id="tick-{{$val}}" style="display:none">&nbsp;&nbsp;<span class="icon-size2 icon-tick icon-green"></span></span>
            </p>
        @endforeach
    </div>
@endforeach

<script>
// Altera o display do tick
$('.tick').on('change', function() {
    var id = $(this).attr('id');
    var qty = $("#qty-"+id).val();
    if (qty >= 1) {
        $("#tick-"+id).toggle(this.checked);
    }
});
// Insere a qty no ckeckbox pelo id e mostra o tick
$('input[name="qty[]"]').keyup(function() {
    var qty = $( this ).val(),
        str = $(this).attr('id'),
        res = str.split("-"),
        tam = $( "#"+res[1] ).val(qty);
    // Altera o display do tick
    if (qty >= 1 && $('#'+res[1]).is(':checked')) {
        $("#tick-"+res[1]).show();
    } else {
        $("#tick-"+res[1]).hide();
    }

}).keyup();

$("#check-all").change(function(){
    if($(this).is(':checked')){
        $(".tick > input[type=checkbox]").each(function() {            
            var input = $(this);
            input.parent().addClass('checked');
            var id = input.attr('id');
            $('#'+id).attr('checked', true);
        });
    }else{
        $(".tick > input[type=checkbox]").each(function() {            
            var input = $(this);
            input.parent().removeClass('checked');
            var id = input.attr('id');
            $('#'+id).attr('checked', false);
        });
    } 
});
</script>