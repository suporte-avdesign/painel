<div id="modal-contents">
    <form id="form-contents" method="POST" action="{{route('privacy-policy.update', $data->id)}}" onsubmit="return false">
        <input type="hidden" name="type" value="{{$data->type}}">
        <input type="hidden" name="order" value="{{$data->order}}">
        <input type="hidden" name="status" value="{{$data->status}}">
        @method('PUT')
        @csrf
        <fieldset class="fieldset">
            <p class="block-label button-height">
                <label for="title" class="label">Titulo <small>Caixa Alta (max 255 chars) </small></label>
                <input type="text" name="title" class="input full-width" value="{{$data->title}}">
            </p>
            <p class="button-height inline-label">
            </p>
            <p class="button-height block-label">
                <label for="description" class="label"> Descrição <span class="red">*</span></label>
                <textarea id="editor1" name="description" class="input full-width">{{$data->description}}</textarea>
            </p>

            <p class="button-height align-center">
                <span class="button-group">
                    <button onclick="fechaModal()" class="button"> Cancelar </button>
                    @can('contents-site-create')
                        <button id="btn-modal" onclick="formContents('update', 'contents', '{{route('privacy-policy.load')}}')" class="button blue-gradient">
                        <span class="icon-publish"></span> Alterar
                    </button>
                    @endcan
                </span>
            </p>
        </fieldset>
    </form>
</div>
<!-- CKEditor -->
<script src="{{url('assets/backend/js/libs/ckeditor4/ckeditor.js')}}"></script>
<script src="{{url('assets/backend/js/libs/ckeditor4/config.js')}}"></script>
<script>
    CKEDITOR.replace( 'editor1', {
        height: 150,
    });
</script>
