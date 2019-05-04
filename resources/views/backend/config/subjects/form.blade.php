<div id="modal-subjects">
    @if(isset($data))
    <form id="form-subjects" method="POST" action="{{route('contact-subjects.update', $data->id)}}" onsubmit="return false">
        <input name="_method" type="hidden" value="PUT">
    @else
    <form id="form-subjects" method="POST" action="{{route('contact-subjects.store')}}" onsubmit="return false">
    @endif
        {{csrf_field()}}
        <fieldset class="fieldset">
            <p class="button-height inline-label">
                <label for="label" class="label"> Assunto <span class="red">*</span></label>
                <input type="text" name="label" class="input full-width" value="{{$data->label or old('label')}}">
            </p>
            <p class="button-height block-label">
                <label for="message" class="label"> Mensagem <span class="red">*</span></label>
                <textarea rows="10" name="message" class="input full-width">{{$data->message or 'Mensagem'}}</textarea>
            </p>
            <p class="button-height inline-label">
                <label for="order" class="label">Visitantes <span class="red">*</span></label>
                <span class="button-group">
                    <label for="send_guest_1" class="button blue-active">
                        @if(isset($data))
                            <input type="radio" name="send_guest" id="send_guest_1" value="1" {{{ $data->send_guest == 1 ? 'checked' : '' }}}>
                        @else
                            <input type="radio" name="send_guest" id="send_guest_1" value="1" checked>
                        @endif
                        Enviar mensagem
                    </label>
                    <label for="send_guest_0" class="button red-active">
                        @if(isset($data))
                            <input type="radio" name="send_guest" id="send_guest_0" value="0" {{{ $data->send_guest == 0 ? 'checked' : '' }}}>
                        @else
                            <input type="radio" name="send_guest" id="send_guest_0" value="0">
                        @endif
                        Não enviar mensagem
                    </label>
                </span>
            </p>

            <p class="button-height inline-label">
                <label for="order" class="label">Clientes <span class="red">*</span></label>
                <span class="button-group">
                    <label for="send_user_1" class="button blue-active">
                        @if(isset($data))
                            <input type="radio" name="send_user" id="send_user_1" value="1" {{{ $data->send_user == 1 ? 'checked' : '' }}}>
                        @else
                            <input type="radio" name="send_user" id="send_user_1" value="1" checked>
                        @endif
                        Enviar mensagem
                    </label>
                    <label for="send_user_0" class="button red-active">
                        @if(isset($data))
                            <input type="radio" name="send_user" id="send_user_0" value="0" {{{ $data->send_user == 0 ? 'checked' : '' }}}>
                        @else
                            <input type="radio" name="send_user" id="send_user_0" value="0">
                        @endif
                        Não enviar mensagem
                    </label>
                </span>
            </p>
            <p class="button-height inline-label">
                <label for="order" class="label">Ordem / Status <span class="red">*</span></label>
                <span class="number input margin-right">
                    <button type="button" class="button number-down">-</button>
                    <input type="text" name="order" value="{{$data->order or old('order')}}" class="input-unstyled order" size="2">
                    <button type="button" class="button number-up">+</button>
                </span>
                <span class="button-group">
                    <label for="status-1" class="button blue-active">
                        @if(isset($data))
                            <input type="radio" name="status" id="status-1" value="1" {{{ $data->status == 1 ? 'checked' : '' }}}>
                        @else
                            <input type="radio" name="status" id="status-1" value="1" checked>
                        @endif
                        Ativo
                    </label>
                    <label for="status-0" class="button red-active">
                        @if(isset($data))
                            <input type="radio" name="status" id="status-0" value="0" {{{ $data->status == 0 ? 'checked' : '' }}}>
                            Inativo
                        @else
                            <input type="radio" name="status" id="status-0" value="0">
                            Inativo
                        @endif
                    </label>
                </span>
            </p>

            <p class="button-height align-center">
                <span class="button-group">
                    <button onclick="fechaModal()" class="button"> Cancelar </button>
                    @if(isset($data))
                        @can('config-subject-update')
                            <button id="btn-modal" onclick="formSubjects('update', 'subjects', '{{route('contact-subjects.load')}}')" class="button icon-	outbox blue-gradient">
                        <span class="icon-publish"></span> Alterar
                        </button>
                        @endcan
                    @else
                        @can('config-subject-create')
                            <button id="btn-modal" onclick="formSubjects('create', 'subjects', '{{route('contact-subjects.load')}}')" class="button blue-gradient">
                            <span class="icon-publish"></span> Salvar
                        </button>
                        @endcan
                    @endif
                </span>
            </p>
        </fieldset>
    </form>
</div>
