<hgroup id="main-title" class="thin">
    <h1>Canvas Hexadecimal</h1>
</hgroup>

<div class="with-padding">
    <div class="wrapped margin-bottom big-left-icon icon-gear">
        <h4 class="no-margin-bottom">Canvas Hexadecimal</h4>        
        Este recurso requer o arquivo de plugin <b>js/avd.canvas.js</b>
    </div>
    
    <form id="form-post" action="painel.dev/painel#content/reference/crop-color-piker.php" method="POST" >
        <fieldset class="fieldset">
            <legend class="legend">Image Canvas</legend>
            <div class="columns">
                <!-- form -->
                <div class="five-columns twelve-columns-tablet">
                    <h4 class="green underline">Form:</h4>
                    <p class="button-height inline-small-label">
                        <label for="input-2" class="label">Small</label>
                        <input type="text" name="input-2" id="input-2" class="input" value="">
                    </p>

                    <p class="button-height inline-label">
                        <label for="input-3" class="label">Normal label</label>
                        <input type="text" name="input-3" id="input-3" class="input" value="">
                    </p>
                    <p class="button-height inline-medium-label">
                        <label for="input-4" class="label">Medium label</label>
                        <input type="text" name="input-4" id="input-4" class="input" value="">
                    </p>
                    <p class="button-height inline-medium-label">
                        <label for="radio-1" class="label">Radio</label>
                        <span class="button-group">
                            <label for="button-radio-1" class="button green-active">
                                <input type="radio" name="button-radio" id="button-radio-1" value="1" checked>
                                um
                            </label>
                            <label for="button-radio-2" class="button green-active">
                                <input type="radio" name="button-radio" id="button-radio-2" value="2">
                                dois
                            </label>
                            <label for="button-radio-3" class="button green-active">
                                <input type="radio" name="button-radio" id="button-radio-3" value="3">
                                tres
                            </label>
                        </span>
                    </p>                    
                    <p class="button-height inline-medium-label">
                        <label for="checkbox-1" class="label">Checkbox</label>
                        <span class="button-group">
                            <label for="button-checkbox-1" class="button green-active">
                                <input type="checkbox" name="button-checkbox-1" id="button-checkbox-1" value="1">
                                First
                            </label>
                            <label for="button-checkbox-2" class="button green-active">
                                <input type="checkbox" name="button-checkbox-2" id="button-checkbox-2" value="2" checked>
                                Second
                            </label>
                            <label for="button-checkbox-3" class="button green-active">
                                <input type="checkbox" name="button-checkbox-3" id="button-checkbox-3" value="3">
                                Third
                            </label>
                        </span>
                    </p>                    
                    <p class="button-height inline-small-label">
                        <label for="input-2" class="label">Input</label>
                        <span class="input">
                            <label for="pseudo-input-2" class="button orange-gradient">
                                <span class="icon-phone small-margin-right"></span>
                            </label>
                            <select name="pseudo-input-select" class="select compact expandable-list" style="width: 100px">
                                <option value="USA">USA</option>
                                <option value="United Kingdom">United Kingdom</option>
                                ...
                            </select>
                            <input type="text" name="pseudo-input-2" id="pseudo-input-2" class="input-unstyled input-sep" placeholder="Area" value="" maxlength="3" style="width: 30px;">
                            <input type="text" name="pseudo-input-3" id="pseudo-input-3" class="input-unstyled" placeholder="Number" value="" style="width: 80px;">
                        </span>                    
                    </p>                    
                    <p class="button-height inline-small-label">
                        <label for="count-1" class="label">Count 1</label>
                        <span class="number input margin-right">
                            <button type="button" class="button number-down">-</button>
                            <input type="text" value="20" size="4" class="input-unstyled" data-number-options='{"min":15,"max":30,"increment":0.5,"shiftIncrement":5,"precision":0.25}'>
                            <button type="button" class="button number-up">+</button>
                        </span>                    
                    </p>
                    <p class="button-height inline-small-label">
                        <label for="count-2" class="label">Count 2</label>
                        <span class="number input margin-right">
                            <button type="button" class="button number-down">-</button>
                            <input type="text" value="320" size="3" class="input-unstyled">
                            <button type="button" class="button number-up">+</button>
                        </span>
                    </p>                    
                </div>
                <!-- canvas -->
                <div class="five-columns eight-columns-tablet">
                    <h4 class="green underline">Upload tamanho minimo 1200x1200</h4>
                    <div class="wrapped margin-bottom">
                        <p class="button-height">
                            <input type="file" name="file" id="uploadCanvas" value="" class="file" onmouseover="createCanvas(350,350)" onchange="loadCanvasFile();" />
                            <img id="slika" style="display:none" src="imagens/produtos/1200x1200/distribuidor-de-calcados-categoria-1-verde-secao-1-fabricante-1-nvlnonnasn-12345.jpg" />
                            <canvas onmouseover="createCanvas(350,350)" id="myCanvas" width="350" height="350" style="margin-top:10px;">
                                O seu navegador não suporta a etiqueta HTML5 para canvas.
                            </canvas>
                        </p>
                    </div>
                </div>
                <!-- miniaturas -->
                <div class="two-columns two-columns-tablet">
                    <h4 class="green underline">Miniatura</h4>
                    <div class="wrapped margin-bottom">
                        <div align="center">
                            <a href="javascript:createCanvas(350,350)" class="button icon-camera">Cortar</a>
                        </div>
                        <div  align="center">
                            <canvas  id="pixCanvas" width="100%" height="100%" style="margin-top:10px; z-index: 0;">
                                O seu navegador não suporta a etiqueta HTML5 para canvas.
                            </canvas>
                        </div>
                        <div class="button-height" align="center">
                            <input type="text" name="pixcolor" id="pixcolor" class="input" maxlength="7" style="width:82px">
                            <p id="barvadiv" style="margin-top:2px;width:100px;height:100px"></p>
                        </div>
                        <div align="center">
                            <br>
                            <label for="title" class="label strong">Grupo de cores</label>
                            <span id="grupo" class="d-none"></span>
                            <select id="piker-cores" name="piker[]" multiple="multiple">
                                <option value="#000000">Selecione</option>
                                <option value="#a9a9a9">Selecione</option>
                                <option value="#ffffff">Selecione</option>
                                <option value="#0000cd">Selecione</option>
                                <option value="#8000ff">Selecione</option>
                                <option value="#4682b4">Selecione</option>
                                <option value="#6495ed">Selecione</option>
                                <option value="#00bfff">Selecione</option>
                                <option value="#afeeee">Selecione</option>
                                <option value="#006400">Selecione</option>
                                <option value="#2e8b57">Selecione</option>
                                <option value="#32cd32">Selecione</option>
                                <option value="#6b8e23">Selecione</option>
                                <option value="#9acd32">Selecione</option>
                                <option value="#90ee90">Selecione</option>
                                <option value="#00ff00">Selecione</option>
                                <option value="#20b2aa">Selecione</option>
                                <option value="#7fffd4">Selecione</option>
                                <option value="#008b8b">Selecione</option>
                                <option value="#dc143c">Selecione</option>
                                <option value="#ff6347">Selecione</option>
                                <option value="#800000">Selecione</option>
                                <option value="#a52a2a">Selecione</option>
                                <option value="#cd5c5c">Selecione</option>
                                <option value="#cd853f">Selecione</option>
                            </select>
                            <span id="grupo-cores" class="d-none"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div align="center">
                <button type="submit" class="button icon-star">Create</button>
            </div>
        </fieldset>
    </form>


</div>
<script type="text/javascript">
    createCanvas(350,350);
</script>
<script>
    // Grupo Cores
    var checks = "";
    $( "#piker-cores option:selected" ).each(function() {
        var color = $( this ).val(),
        idc = color.replace("#","");
        checks += '<input id="'+idc+'" type="checkbox" name="grupo['+color+']"  value="1" checked>';
    });
    $( "#grupo-cores" ).html( checks );
    $('#grupo').on('click', function() {
        $('select[name="piker[]"]').simplecolorpicker({
            multiple: true,
            element: 'grupo-cores',
            theme: 'fontawesome'
        });
    });
    $('#grupo').trigger('click');
</script>
