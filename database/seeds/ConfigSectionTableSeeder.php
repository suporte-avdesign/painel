<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigSection;

class ConfigSectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        ConfigSection::create([
            'grids' => 1,
            'description' => 1,
            'img_default' => 'D',
            'path' => 'imagens/secoes/',
            'img_featured' => 1,
            'width_featured' => 234,
            'height_featured' => 319,
            'img_banner' => 1,
            'width_banner' => 870,
            'height_banner' => 229,
            'width_modal' => 400,
            'height_modal' => 400,
            'created_at' => $date
        ]);
    }
}
