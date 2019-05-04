<div class="button-height">
	<select id="select-profile" class="select easy-multiple-selection check-list" multiple>
		<option selected>First value</option>
		<option selected>Second value</option>
		<option selected>Selected value</option>
		<option selected>Last value</option>
	</select>
</div>

<script>
$( "#select-profile" ).change(function () {
	//var str = "";
	$( "select option:selected" ).each(function() {
		str += $( this ).text() + " ";
	});
	//$( "div" ).text( str );
}).change();
</script>
