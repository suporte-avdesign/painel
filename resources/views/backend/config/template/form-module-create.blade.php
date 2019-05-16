<div id="modal-template">
    <form id="form-template" method="POST" action="{{route('template-site.store')}}" onsubmit="return false">
        @csrf
        <fieldset class="fieldset">
            <p class="block-label button-height">
                <label for="page" class="label">Página do Site <span class="red">*</span></label>
                <select id="config page id" name="config page id" class="select">
                    <option value="">{{$config['select_text']}}</option>
                    @foreach($pages as $page)
                        <option value="{{$page->id}}">{{$page->name}}</option>
                    @endforeach
                </select>
            </p>
            <p class="block-label button-height">
                <label for="name" class="label">Nome <span class="red">*</span></label>
                <input type="text" name="name" class="input" value="">
            </p>
            <p class="block-label button-height">
                <label for="module" class="label">Modulo <span class="red">*</span></label>
                <input type="text" name="module" class="input" value="">
            </p>
            <p class="block-label button-height">
                <label for="tmp" class="label">Template / Status <span class="red">*</span></label>
                <span class="number input margin-right">
                    <button type="button" class="button number-down">-</button>
                    <input type="text" name="tmp" value="1" class="input-unstyled order" size="2">
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
                    @can('config-site-create')
                        <button id="btn-modal" onclick="formTemplate('create', 'template', '{{route('page-site-load')}}')" class="button blue-gradient">
                        <span class="icon-publish"></span> Salvar
                    </button>
                    @endcan
                </span>
            </p>
        </fieldset>
    </form>
</div>