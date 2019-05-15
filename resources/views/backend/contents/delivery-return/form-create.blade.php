<div id="modal-contents">
    <form id="form-contents" method="POST" action="{{route('delivery-return.store')}}" onsubmit="return false">
        <input type="hidden" name="type" value="content">
        @csrf
        <fieldset class="fieldset">
            <p class="block-label button-height">
                <label for="title" class="label">Titulo <small>Caixa Alta (max 255 chars) </small></label>
                <input type="text" name="title" class="input full-width" value="">
            </p>
            <p class="button-height inline-label">
            </p>
            <p class="button-height block-label">
                <label for="description" class="label"> Descrição <span class="red">*</span></label>
                <textarea id="editor1" rows="2" name="description" class="input full-width"></textarea>
            </p>

            <p class="button-height inline-label">
                <label for="order" class="label">Ordem / Status <span class="red">*</span></label>
                <span class="number input margin-right">
                    <button type="button" class="button number-down">-</button>
                    <input type="text" name="order" value="" class="input-unstyled order" size="2">
                    <button type="button" class="button number-up">+</button>
                </span>
                <span class="button-group">
                    <label for="status-1" class="button blue-active">
                        <input type="radio" name="status" id="status-1" value="Ativo" checked>
                        Ativo
                    </label>
                    <label for="status-0" class="button red-active">
                        <input type="radio" name="status" id="status-0" value="Inativo">
                        Inativo
                    </label>
                </span>
            </p>

            <p class="button-height align-center">
                <span class="button-group">
                    <button onclick="fechaModal()" class="button"> Cancelar </button>
                    @can('contents-site-create')
                        <button id="btn-modal" onclick="formContents('create', 'contents', '{{route('delivery-return.load')}}')" class="button blue-gradient">
                        <span class="icon-publish"></span> Salvar
                    </button>
                    @endcan
                </span>
            </p>
        </fieldset>
    </form>
</div>
<!-- CKEditor -->
<script src="{{url('assets/backend/js/libs/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('assets/backend/js/libs/ckeditor/config.js?')}}{{time()}}"></script>
<script>
    CKEDITOR.replace( 'editor1', {
        height: 150,
    });
</script>

