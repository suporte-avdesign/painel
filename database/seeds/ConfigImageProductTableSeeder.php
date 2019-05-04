<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigImageProduct;

class ConfigImageProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ConfigImageProduct::create([
            'type' => 'C',
            'path' => 'assets/imagens/produtos/100x100/',
            'width' => '100',
            'height' => '100',
            'default' => 'T'
        ]);

        ConfigImageProduct::create([
            'type' => 'C',
            'path' => 'assets/imagens/produtos/370x370/',
            'width' => '370',
            'height' => '370',
            'default' => 'N'

        ]);

        ConfigImageProduct::create([
            'type' => 'C',
            'path' => 'assets/imagens/produtos/800x800/',
            'width' => '800',
            'height' => '800',
            'default' => 'G'

        ]);

        ConfigImageProduct::create([
            'type' => 'C',
            'path' => 'assets/imagens/produtos/1000x1000/',
            'width' => '1000',
            'height' => '1000',
            'default' => 'Z'
        ]);

        ConfigImageProduct::create([
            'type' => 'P',
            'path' => 'assets/imagens/produtos/100x100/',
            'width' => '100',
            'height' => '100',
            'default' => 'T'
        ]);

        ConfigImageProduct::create([
            'type' => 'P',
            'path' => 'assets/imagens/produtos/370x370/',
            'width' => '370',
            'height' => '370',
            'default' => 'N'

        ]);

        ConfigImageProduct::create([
            'type' => 'P',
            'path' => 'assets/imagens/produtos/800x800/',
            'width' => '800',
            'height' => '800',
            'default' => 'G'

        ]);

        ConfigImageProduct::create([
            'type' => 'P',
            'path' => 'assets/imagens/produtos/1000x1000/',
            'width' => '1000',
            'height' => '1000',
            'default' => 'Z'
        ]);


    }
}
