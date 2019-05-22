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
            'active' => constLang('active_true'),
            'path' => 'imagens/banners/',
            'width' => '1262',
            'height' => '256',
            'created_at' => $date
        ]);
    }
}
