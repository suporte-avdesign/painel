<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigSubjectContact;


class ConfigSubjectContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigSubjectContact::create([
            'label' => 'Sobre compras',
            'message' => 'Mensagem Sobre compras',
            'order' => '01',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 0
        ]);

        ConfigSubjectContact::create([
            'label' => 'Ativar Cadastro',
            'message' => 'Mensagem Ativar Cadastro',
            'order' => '02',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 0
        ]);

        ConfigSubjectContact::create([
            'label' => 'Sugestões',
            'message' => 'Mensagem Sugestões',
            'order' => '03',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 0
        ]);

        ConfigSubjectContact::create([
            'label' => 'Reclamações',
            'message' => 'Mensagem Reclamações',
            'order' => '04',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 1
        ]);

        ConfigSubjectContact::create([
            'label' => 'Assinar/Cancelar Newsletter',
            'message' => 'Mensagem Assinar/Cancelar Newsletter',
            'order' => '05',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 1
        ]);

        ConfigSubjectContact::create([
            'label' => 'Outro',
            'message' => 'Mensagem Outro',
            'order' => '06',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 1
        ]);

        ConfigSubjectContact::create([
            'label' => 'Erros no site',
            'message' => 'Mensagem Erros no site',
            'order' => '07',
            'status' => 1,
            'send_guest' => 1,
            'send_user' => 1
        ]);


    }
}

