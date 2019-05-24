<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigColorPosition;


class ConfigColorPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigColorPosition::create([
            'type' => 'C',
            'path' => 'imagens/produtos/100x100/',
            'width' => '100',
            'height' => '100',
            'default' => 'T'
        ]);

        ConfigColorPosition::create([
            'type' => 'C',
            'path' => 'imagens/produtos/370x370/',
            'width' => '370',
            'height' => '370',
            'default' => 'N'

        ]);

        ConfigColorPosition::create([
            'type' => 'C',
            'path' => 'imagens/produtos/800x800/',
            'width' => '800',
            'height' => '800',
            'default' => 'G'

        ]);

        ConfigColorPosition::create([
            'type' => 'C',
            'path' => 'imagens/produtos/1000x1000/',
            'width' => '1000',
            'height' => '1000',
            'default' => 'Z'
        ]);

        ConfigColorPosition::create([
            'type' => 'P',
            'path' => 'imagens/produtos/100x100/',
            'width' => '100',
            'height' => '100',
            'default' => 'T'
        ]);

        ConfigColorPosition::create([
            'type' => 'P',
            'path' => 'imagens/produtos/370x370/',
            'width' => '370',
            'height' => '370',
            'default' => 'N'

        ]);

        ConfigColorPosition::create([
            'type' => 'P',
            'path' => 'imagens/produtos/800x800/',
            'width' => '800',
            'height' => '800',
            'default' => 'G'

        ]);

        ConfigColorPosition::create([
            'type' => 'P',
            'path' => 'imagens/produtos/1000x1000/',
            'width' => '1000',
            'height' => '1000',
            'default' => 'Z'
        ]);
    }
}
