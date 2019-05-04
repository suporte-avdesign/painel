<p class="button-height inline-label">
    <label for="first_name" class="label"> Nome <span class="red">*</span></label>
    <input type="text" id="first_name" name="user[first_name]" class="input full-width" value="{{$data->first_name or old('first_name')}}">
</p>
<p class="button-height inline-label">
    <label for="last_name" class="label"> Sobre Nome <span class="red">*</span></label>
    <input type="text" id="last_name" name="user[last_name]" class="input full-width" value="{{$data->last_name or old('last_name')}}">
</p>
<p class="button-height inline-label">
    <label for="document1" class="label"> CPF <span class="red">*</span></label>
    <input type="text" id="document1" name="user[document1]" class="input full-width" value="{{$data->document1 or old('document1')}}">
</p>
<p class="button-height inline-label">
    <label for="document2" class="label"> RG <span class="red">*</span></label>
    <input type="text" id="document2" name="user[document2]" class="input full-width" value="{{$data->document2 or old('document2')}}">
</p>
<p/>
<script>
    $( document ).ready(function() {
        $("#document1").mask("999.999.999-99");
    });
</script>