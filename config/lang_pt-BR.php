<?php
/*
|------------------------------------------------------------------------------------
| Order A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z
|------------------------------------------------------------------------------------
*/

return [
    /*
    |--------------------------------------------------------------------------
    | Corrigir
    |--------------------------------------------------------------------------
    */

    // add
    'title_create' => 'Adicionar ',
    // edit
    'title_edit' => 'Editar ',



    /*
    |--------------------------------------------------------------------------
    | Corrigir
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Field texts
    |--------------------------------------------------------------------------
    */
    'active_true' => 'Ativo',
    'active_false' => 'Inativo',
    'add' => 'Adicionar',
    'alert' => [
        'cover_new' => 'O sistema criou uma nova imagem capa.',
        'cover_false' => 'Você não tem nehuma imagem capa com o status ativo!',
        'cover_inactive' => 'A imagem não pode ser capa com o status inativo',
        'cover_product_false' => 'Como não existe nenhuma imagem ativa o produto foi desativado.',
        'cover_product_true' => 'O status do produto também já esta ativo, Boas vendas!'
    ],
    'back' => 'Voltar ',
    'black_friday' => 'Black Friday',
    'category' => 'Categoria',
    'code' => 'Código',
    'color' => 'Cor',
    'colors' => 'Cores',
    'cost' => 'Custo',
    'cover' => 'capa',
    'created' => 'Criou',
    'delete' => 'Excluir ',
    'delete_false' => 'Não foi possível excluir o registro',
    'delete_true' => 'O registro foi excluido',
    'deleted' => 'Excluiu',
    'description' => 'Descrição',
    'description_painel' => 'Painel Administrativo',
    'edit' => 'Editar',
    'entry' => 'Entrada',
    'error' => [
        'server' => 'Houve um erro no servidor!',
        '404'  => 'Página não encontrada',
    ],
    'featured' => 'Destaque',
    'grid'  => 'Grade',
    'group'  => 'Grupo',
    'genders.required' => 'Os gêneros são obrigatórios',
    'image' => 'Imagem',
    'images' => [
        'add' => 'Adicionar Imagem',
        'delete' => 'Excluir Imagem',
        'edit' => 'Editar Imagem',
        'count_true' => 'Clique na imagem para editar',
        'count_false' => 'Não existe imagem para este produto',
        'deleted_true' => 'A imagem foi excluida',
        'deleted_false' => 'Não foi possível excluir a imagem'
    ],
    'keywords.required' => 'As tags são obrigatórias',
    'login' => 'Login',
    'login_entry' => 'Fez login no sistema.',
    'new' => 'Novo',
    'not' => 'Não',
    'offer' => 'Oferta',
    'order' => 'Ordem',
    'order_false' => 'Não foi possível alterar a ordem',
    'order_true' => 'A ordem foi alterada',
    'payment_card' => 'Cartão de Crédito',
    'payment_cash' => 'Pagamento à Vista',
    'position' => 'Posição',
    'product' => 'Produto',
    'profile_name' => [
        'admin' => 'Admin',
        'user' => 'Cliente'
    ],
    'reminder' => 'Lebre-me',
    'save' => 'Salvar',
    'section' => 'Seção',
    'status' => 'Status',
    'status_change' => 'Alterar Status',
    'status_true' => 'O status foi alterado',
    'status_false' => 'Não foi possível alterar o status',
    'stock' => 'Estoque',
    'tables_preference' => 'a configuração das cores das tabelas por uma de sua preferência',
    'title_update' => 'Alterar',
    'trend' => 'Têndencia',
    'type_movement' => [
        'input' => 'Entrada',
        'output' => 'Saida',
        'delete' => 'Exclusão'
    ],
    'updated' => 'Alterou',
    'update_false' => 'Não foi possível alterar o registro',
    'update_true' => 'O registro foi alterado',
    'upload_true' => [
        'file' => 'O arquivo foi salvo',
        'image' => 'A imagem foi salva',
        'pdf' => 'O PDF foi salvo',
        'photo' => 'A foto foi salva',
        'position' => 'Upload foto posição',
    ],
    'upload_false' => [
        'file' => 'Não foi possível fazer o upload do arquivo',
        'image' => 'Não foi possível fazer o upload da imagem',
        'pdf' => 'Não foi possível salvar o PDF',
        'photo' => 'Não foi possível fazer o upload da foto'
    ],
    'value' => 'Valor',
    'yes' => 'Sim',


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    'validation' => [
        'categories.required' => 'As categorias são obrigatórias',
        'commission' => [
            'required' => 'Comissionado: Sim ou Não?'],
        'description.required' => 'A descrição é obrigatória',
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
        'title' => [
            'required' => 'O nome do titulo é obrigatório',
            'unique' => 'Este titulo já se encontra utilizado'
        ],

        'width_photo' => [
            'required' => 'A largura da foto é obrigatória.',
            'numeric' => 'Digite apenas números na largura da foto.'],
        'status' => [
            'required' => 'O status é obrigatório.'],
        'verifying_credentials' => 'Verificando credenciais',

    ],
    'messages' => [
        'products' => [
            'delete_true' => 'Excluiu o Produto',
            'delete_false' => 'Não foi possível excuir o produto',
            'total_colors' => 'Total de Cores'
        ],
    ]
];