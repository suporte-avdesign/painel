<form id="form-colors" method="post" action="{{route('colors-product.store', $idpro)}}" enctype="multipart/form-data">
    @csrf
    @if($configProduct->stock == 1)
        <!-- Altera o value ao clicar no btn stock -->
        @if(isset($product))
            <input type="hidden" id="grid_stock" name="stock" value="{{$product->stock}}">
        @else
            <input type="hidden" id="grid_stock" name="stock" value="1">
        @endif
    @else
        <input type="hidden" id="grid_stock" name="stock" value="0">
    @endif

    @if($configProduct->kit == 1)
        <!-- Altera o value ao clicar no btn kit -->
        @if(isset($product))
            <input type="hidden" id="grid_kit" name="kit" value="{{$product->kit}}">
        @else
            <input type="hidden" id="grid_kit" name="kit" value="1">
        @endif
    @else
        <input type="hidden" id="grid_kit" name="kit" value="0">
    @endif

    <span id="insert_product"><!-- inserir input hidden produto_id com jquery  --></span>

    @if(isset($product))
        <!--inserir uma ac adicionar com o campo  product_id -->
        <input type="hidden" name="img[ac]" value="add">
        <input type="hidden" name="img[product_id]" value="{{$product->id}}">
        <input type="hidden" name="img[brand]" value="{{$product->brand}}">
        <input type="hidden" name="img[category]" value="{{$product->section}}">
        <input type="hidden" name="img[section]" value="{{$product->category}}">
        <input type="hidden" name="img[product_name]" value="{{$product->name}}">
    @else
        <input type="hidden" name="img[ac]" value="create">
    @endif
    <!-- Modules: hexa -->
    <div class="columns">
        <!-- form -->
        <div class="four-columns twelve-columns-tablet">
            <!-- Form: colors -->
            @include('backend.colors.form_hexa')


            <!-- Modulo: grids -->
            @if($configProduct->grids == 1)
                @include('backend.colors-grids.layout-create')
            @endif

        </div>
        <!-- canvas -->
        <div class="six-columns eight-columns-tablet">
            <h4 class="green underline">Tamanho {{$pixel->width}}x{{$pixel->height}} Aqui</h4>
            <div class="wrapped margin-bottom">
                <p class="button-height">
                    <input type="file" name="file" id="uploadCanvas" value="" class="file" onmouseover="createCanvas(350,350)" onchange="loadCanvasFile()" />
                    <img id="slika" style="display:none" src="">
                    <canvas onmouseover="createCanvas(350,350)" id="myCanvas" width="350" height="350" style="margin-top:10px;">
                        O seu navegador não suporta a etiqueta HTML5 para canvas.
                    </canvas>
                </p>
            </div>

            @if($configProduct->kit == 1 && isset($product))
                <p class="button-height inline-label">
                    <span class="input">
                        <label for="kit_img_1" class="button compact green-active">
                                <input type="radio" name="img[kit]"  id="kit_img_1" onclick="setKitColor('1','{{$idpro}}','painel/produto','create')" value="1" @if($product->kit == 1) checked @endif>
                            Ativo
                        </label>
                        <label for="kit_img_2" class="button compact red-active" >
                            <input type="radio" name="img[kit]" id="kit_img_2" onclick="setKitColor('0','{{$idpro}}','painel/produto','create')" value="0" @if($product->kit == 0) checked @endif>
                            Inativo
                        </label>
                        <span id="kits" @if($product->kit == 0) class="display-none" @endif>
                            <select name="img[kit_name]" class="select compact expandable-list" style="width: 100px">
                                @foreach($kits as $key => $val)
                                    <option value="{{$val}}"
                                    @if($product->kit_name == $val) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </span>
                    </span>
                </p>
            @else
                <span class="display-none"><input type="checkbox" name="img[kit]" value="0" checked></span>
            @endif

            @if($configProduct->stock == 1 && isset($product))
                <p class="button-height inline-label">
                    <label for="stock_img" class="label">Estoque</label>
                    <span class="input">
                        <label for="stock_img_1" class="button compact green-active">
                            <input type="radio" name="img[stock]"  id="stock_img_1" onclick="setStockColor('1','{{$idpro}}','painel/produto','create')" value="1" checked >
                            Ativo
                        </label>
                        <label for="stock_img_2" class="button compact red-active" >
                            <input type="radio" name="img[stock]" id="stock_img_2" onclick="setStockColor('0','{{$idpro}}','painel/produto','create')" value="0" >
                            Inativo
                        </label>
                    </span>
                </p>
            @else
                <span class="display-none"><input type="checkbox" name="img[stock]" value="0" checked></span>
            @endif

            <div id="submit-colors" align="center">
                <button id="btn-colors" type="submit" class="button glossy">
                    Proximo
                    <span  class="button-icon right-side"><span class="icon-forward"></span></span>
                </button>
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
                    <canvas  id="pixCanvas" width="100%" height="100%" style="margin-top:10px; z-index:0;">
                        O seu navegador não suporta a etiqueta HTML5 para canvas.
                    </canvas>
                </div>
                <div class="button-height" align="center">
                    <input type="text" name="img[html]" id="pixcolor" value="" class="input" maxlength="7" style="width:82px">
                    <p id="barvadiv" style="margin-top:2px;width:100px;height:100px"></p>
                </div>

                @if($configProduct->group_colors == 1)                    
                    @include('backend.colors-groups.group_hexa')
                @endif

            </div>
        </div>
    </div>
</form>
<script src="{{mix('backend/js/avd.hexa.min.js')}}"></script>
<script>createCanvas(350,350);</script>