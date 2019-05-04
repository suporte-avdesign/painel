<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\Admin;
use AVDPainel\Models\Admin\ConfigSystem;
use AVDPainel\Models\Admin\AdminAccess;

class AdminsTableSeeder extends Seeder
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

        Admin::create([
            'id' => $id,
        	'name' => 'Anselmo',
        	'login' => 'Anselmo',
            'profile' => 'Master',
            'phone' => '(11) 96938-4849',
            'email' => 'suporte.avdesign@gmail.com',
            'status' => 'Ativo',
            'commission' => 'Sim',
            'percent' => 1,
        	'password' => bcrypt('avdesign'),
            'created_at' => $date
        ]);

        ConfigSystem::create([
            'admin_id' => $id,
            'table_color' => 'anthracite-gradient',
            'table_color_sel' => 'anthracite-gradient',
            'table_limit' => 50,
            'table_open_details' => 'td.details-control',
            'created_at' => $date
        ]);

        AdminAccess::create([
            'admin_id' => $id,
            'last_ip' => '',
            'last_url' => 'config/sistema',
            'last_logout' => '',
            'qty_visits' => 0
        ]);

    }
}
