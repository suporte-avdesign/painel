<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\CompanyPayments;

class CompanyPaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyPayments::create([
            'name' => 'PagSeguro',
            'slug' => 'pagseguro',
            'billet' => 1,
            'cash' => 0,
            'credit_card' => 1,
            'debit_card' => 1
        ]);

        CompanyPayments::create([
            'name' => 'Bradesco',
            'slug' => 'bradesco',
            'billet' => 0,
            'cash' => 1,
            'credit_card' => 0,
            'debit_card' => 0
        ]);
    }
}
