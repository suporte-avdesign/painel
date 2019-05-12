<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigBanner;

class ConfigBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        ConfigBanner::create([
            'type' => 'four',
            'status' => 'Ativo',
            'path' => 'imagens/banners/',
            'width' => '262',
            'height' => '256',
            'created_at' => $date
        ]);
    }
}
