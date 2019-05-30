<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigFormPayment;

class ConfigFormPaymentTableSeeder extends Seeder
{
    /**
     * Table Form Pagament.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        ConfigFormPayment::create([
            'order' => 1,
            'label' => 'Depósito em Conta',
            'description' => '
                -Banco: '.env('DEP_BANK').
                '-Agência: '.env('DEP_AGENCY').'-'.env('DEP_AGENCY_DIG').
                '-Conta Corrente:'.env('DEP_ACCOUNT').'-'.env('DEP_ACCOUNT_DIG'),
                '-Favorecido:'.env('DEP_NAME'),
                '-'.env('DEP_DOCUMENT_NAME').':'.env('DEP_DOCUMENT_NUMBER'),
            'active' => constLang('active_true'),
            'created_at' => $date
        ]);

        ConfigFormPayment::create([
            'order' => 1,
            'label' => 'Boleto Bancário',
            'description' => 'Emita o boleto bancário e pague em qualquer agência.',
            'active' => constLang('active_true'),
            'created_at' => $date
        ]);

        ConfigFormPayment::create([
            'order' => 3,
            'label' => 'Cartão de Crédito',
            'description' => '
                -Acima de R$300,00 - 3x sem juros
                -Acima de R$500,00 - 4x sem juros
                -Acima de R$1000,00 - 5x sem juros',
            'active' => constLang('active_true'),
            'created_at' => $date
        ]);

    }
}
