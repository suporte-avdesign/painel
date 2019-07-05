<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\AccountType;


class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id   = mt_rand(1, '123456789');
        $date = date('Y-m-d H:i:s');

        AccountType::create([
            'id' => $id,
            'name' => constLang('person_legal.name'),
            'active' => constLang('active_true'),
            'created_at' => $date
        ]);

        AccountType::create([
            'id' => $id+1,
            'name' => constLang('person_physical.name'),
            'active' => constLang('active_true'),
            'created_at' => $date
        ]);
    }
}
