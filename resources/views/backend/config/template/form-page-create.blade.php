<div id="modal-page">
    <form id="form-page" method="POST" action="{{route('page-site.store')}}" onsubmit="return false">
        @csrf
        <fieldset class="fieldset">
            <p class="block-label button-height">
                <label for="name" class="label">Nome <span class="red">*</span></label>
                <input type="text" name="name" class="input" value="">
            </p>
            <p class="block-label button-height">
                <label for="module" class="label">Modulo <span class="red">*</span></label>
                <input type="text" name="module" class="input" value="">
            </p>
            <p class="block-label button-height">
                <label for="tmp" class="label">Status <span class="red">*</span></label>
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
                    @can('config-site-create')
                        <button id="btn-modal" onclick="formPage('create', 'page', '{{route('page-site-load')}}')" class="button blue-gradient">
                        <span class="icon-publish"></span> Salvar
                    </button>
                    @endcan
                </span>
            </p>
        </fieldset>
    </form>
</div>