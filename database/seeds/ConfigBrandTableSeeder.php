<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigBrand;

class ConfigBrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        ConfigBrand::create([
            'info' => 1,
            'grids' => 1,
            'description' => 1,
            'img_default' => 'D',
            'path' => 'assets/imagens/marcas/',
            'img_logo' => 1,
            'width_logo' => 173,
            'height_logo' => 91,
            'img_banner' => 1,
            'width_banner' => 870,
            'height_banner' => 229,
            'width_modal' => 400,
            'height_modal' => 400,
            'created_at' => $date
        ]);
    }
}
