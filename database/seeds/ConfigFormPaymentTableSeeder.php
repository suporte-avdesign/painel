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
            'label' => 'Pagamento à Vista',
            'description' => 'Para pagamento à vista no momento só aceitamos "Depósito Bancário".',
            'active' => constLang('active_true'),
            'created_at' => $date
        ]);



        ConfigFormPayment::create([
            'order' => 2,
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
