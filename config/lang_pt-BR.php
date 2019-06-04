<?php
/*
|------------------------------------------------------------------------------------
| Order A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z
|------------------------------------------------------------------------------------
*/

return [

    'company' => 'AV Design',
    'author_name' => 'Anselmo Velame',
    'copy' => '&copy; Todos os direitos reservados',
    'description_painel' => 'Painel Administrativo',

    /*
    |--------------------------------------------------------------------------
    | Modules
    |--------------------------------------------------------------------------
    */
    'ConfigAdmin' => [
       'title' => 'Configuração dos Usuários'
    ],
    'ConfigSystem' => [
        'tables' => 'a configuração das tabelas por uma de sua preferência'
    ],



    /*
    |--------------------------------------------------------------------------
    | Field texts
    |--------------------------------------------------------------------------
    */
    'active_true' => 'Ativo',
    'active_false' => 'Inativo',
    'back' => 'Voltar',
    'code' => 'Código',
    'color' => 'Cor',
    'cost' => 'Custo',
    'cover' => 'capa',
    'categories.required' => 'As categorias são obrigatórias.',
    'delete_false' => 'Não foi possível excluir o registro',
    'delete_true' => 'O registro foi excluido',
    'description' => 'Descrição',
    'description_painel' => 'Painel Administrativo',
    'description.required'  => 'A descrição é obrigatória.',
    'edit' => 'Editar',
    'error_server' => 'Houve um erro no servidor!',
    'error_404' => 'Página não encontrada',
    'grid'  => 'Grade',
    'group'  => 'Grupo',
    'genders.required' => 'Os gêneros são obrigatórios.',
    'image' => 'Imagem',
    'keywords.required' => 'As tags são obrigatórias.',
    'login' => 'Login',
    'not' => 'Não',
    'order' => 'Ordem',
    'order_false' => 'Não foi possível alterar a ordem',
    'order_true' => 'A ordem foi alterada',
    'payment_card' => 'Cartão de Crédito',
    'payment_cash' => 'Pagamento à Vista',
    'product' => 'Produto',
    'profile_name' => [
        'admin' => 'Admin',
        'user' => 'Cliente'
    ],
    'reminder' => 'Lebre-me',
    'status' => 'Status',
    'status_true' => 'O status foi alterado',
    'status_false' => 'Não foi possível alterar o status',
    'title_create' => 'Adicionar',
    'title_edit' => 'Editar',
    'title.required' => 'O nome do titulo é obrigatório.',
    'title.unique' => 'Este titulo já se encontra utilizado.',
    'title_update' => 'Alterar',
    'type_movement' => [
        'input' => 'Entrada',
        'output' => 'Saida'
    ],
    'update_false' => 'Não foi possível alterar o registro',
    'update_true' => 'O registro foi alterado',
    'upload_true' => [
        'file' => 'O arquivo foi salvo',
        'image' => 'A imagem foi salva',
        'pdf' => 'O PDF foi salvo',
        'photo' => 'A foto foi salva',
    ],
    'value' => 'Valor',
    'yes' => 'Sim',


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    'validation' => [

        'commission' => [
            'required' => 'Comissionado: Sim ou Não?'],
        'email' => [
            'email' => 'Digite um endereço de email válido.',
            'required' => 'O email é obrigatório.',
            'unique' => 'Este email já se encontra utilizado.'],
        'height_photo' => [
            'required' => "A altura da foto é obrigatória.",
            'numeric' => 'Digite apenas números na largura da foto.'],
        'login' => [
            'required' => 'O login é obrigatório.',
            'unique' => 'Este usuário já se encontra utilizado.',
            'min' => 'O login deverá conter no mínimo 6 caracteres.',
            'max' => 'O login não deverá conter mais de 10 caracteres.'],
        'name' => [
            'required' => 'O nome é obrigatório.',
            'min' => 'O nome deverá conter no mínimo 6 caracteres.'],
        'password' => [
            'required' => 'A senha  é obrigatória.',
            'max' => 'A senha não deverá conter mais de 10 caracteres.',
            'min' => 'A senha deverá conter no mínimo 6 caracteres.'],
        'password_confirmation' => [
            'required' => 'A confirmação da senha é obrigatória.',
            'same' => 'A confirmação da senha não coincide.'],
        'path_image' => [
            'required' => 'A pasta das imagens é obrigatória.'],
        'percent' => [
            'required' => 'A porcentagem é obrigatória.'],
        'phone' => [
            'required' => 'O telefone é obrigatório.'],
        'profile_id' => [
            'required' => 'O perfil é obrigatório.'],
        'width_photo' => [
            'required' => 'A largura da foto é obrigatória.',
            'numeric' => 'Digite apenas números na largura da foto.'],
        'status' => [
            'required' => 'O status é obrigatório.'],
        'verifying_credentials' => 'Verificando credenciais',

    ],

    'accesses' => [
        'login_entry' => 'Fez login no sistema.',
        'create' => 'Adicionou ',
        'update' => 'Alterou ',
        'delete' => 'Excluiu ',
    ]





];