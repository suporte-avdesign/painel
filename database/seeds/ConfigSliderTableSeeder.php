<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigSlider;


class ConfigSliderTableSeeder extends Seeder
{
    /**
     * Configuração do slider da home
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        ConfigSlider::create([
            'type' => 'banner',
            'status' => 'Ativo',
            'delay' => 3000,
            'path' => 'imagens/slider/',
            'width' => '1260',
            'height' => '1200',
            'width_thumb' => '100',
            'height_thumb' => '95',
            'width_modal' => '800',
            'height_modal' => '800',
            'created_at' => $date
        ]);
    }
}
