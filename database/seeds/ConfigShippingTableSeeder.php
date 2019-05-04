<?php

use Illuminate\Database\Seeder;

use AVDPainel\Models\Admin\ConfigShipping;

class ConfigShippingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        ConfigShipping::create([
            'name' => 'TRANSPORTADORA',
            'description' => 'Você pode indicar uma transportadora de sua preferência (O frete é por conta do cliente)',
            'order' => '01',
            'status' => 'Ativo',
            'created_at' => $date
        ]);

        ConfigShipping::create([
            'name' => 'CORREIO (PAC)',
            'description' => 'Frete por conta do cliente (existem algumas restrições de entrega dos meios disponibilizados pelos Correios, como limite de dimensões).',
            'order' => '02',
            'status' => 'Ativo',
            'created_at' => $date
        ]);

        ConfigShipping::create([
            'name' => 'CORREIO (SEDEX)',
            'description' => 'Frete por conta do cliente (existem algumas restrições de entrega dos meios disponibilizados pelos Correios, como limite de dimensões).',
            'order' => '03',
            'status' => 'Inativo',
            'created_at' => $date
        ]);

        ConfigShipping::create([
            'name' => 'RETIRAR NA LOJA',
            'description' => 'Os produtos deverão ser retirados na própria loja ou em um local combinado.',
            'order' => '04',
            'status' => 'Ativo',
            'created_at' => $date
        ]);

        ConfigShipping::create([
            'name' => 'ENTREGAR EM SÃO PAULO (Capital)',
            'description' => 'Não será cobrado valor adicional para entregas na cidade de São Paulo (pedidos acima de R$ 4000,00) .',
            'order' => '05',
            'status' => 'Inativo',
            'created_at' => $date
        ]);
    }
}
