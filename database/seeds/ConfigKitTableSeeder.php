<?php
use AVDPainel\Models\Admin\ConfigKit;

use Illuminate\Database\Seeder;

class ConfigKitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigKit::create([
        	'name' => 'Caixa',
        	'order' => '01',
            'status' => 'Ativo'
        ]);

        ConfigKit::create([
        	'name' => 'Kit',
        	'order' => '02',
            'status' => 'Ativo'
        ]);

        ConfigKit::create([
        	'name' => 'Embalagem',
        	'order' => '03',
            'status' => 'Ativo'
        ]);
    }
}
