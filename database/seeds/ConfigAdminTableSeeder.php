<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigAdmin;


class ConfigAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        ConfigAdmin::create([
            'path' => 'imagens/users/',
            'width_photo' => 300,
            'height_photo' => 300,
            'created_at' => $date
        ]);
    }
}
