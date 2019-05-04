<?php

use AVDPainel\Models\Admin\ConfigColorGroup;


use Illuminate\Database\Seeder;


class ConfigColorGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigColorGroup::create([ 
                "code" => "#000000",
                "name" => "Preto",
                "order" => '01',
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#a9a9a9",
                "name" => "Cinza",
                "order" => '02',
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#d3d3d3",
                "name" => "Prata",
                "order" => '03',
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ffffff",
                "name" => "Branco",
                "order" => '03',
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#0000cd",
                "name" => "Azul Escuro",
                "order" => "04",
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#6495ed",
                "name" => "Azul Medio",
                "order" => "05",
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#20b2aa",
                "name" => "Azul Turquesa",
                "order" => "06",
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#afeeee",
                "name" => "Azul Claro",
                "order" => "07",
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#006400",
                "name" => "Verde Escuro",
                "order" => "08",
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#32cd32",
                "name" => "Verde Medio",
                "order" => "09",
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#90ee90",
                "name" => "Verde Claro",
                "order" => 10,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ff0000",
                "name" => "Vermelho",
                "order" => 11,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ff8c00",
                "name" => "Laranja",
                "order" => 12,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ffff00",
                "name" => "Amarelo",
                "order" => 13,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#c71585",
                "name" => "Violeta",
                "order" => 14,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#db7093",
                "name" => "Rosa",
                "order" => 15,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ff69b4",
                "name" => "Pink",
                "order" => 16,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#800080",
                "name" => "Lilás ",
                "order" => 17,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#9932cc",
                "name" => "Lilás Light",
                "order" => 18,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#4b0082",
                "name" => "Indigo",
                "order" => 19,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ffc0cb",
                "name" => "Rose",
                "order" => 20,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ee82ee",
                "name" => "Orquídea",
                "order" => 21,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ff00ff",
                "name" => "Magenta",
                "order" => 22,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#800000",
                "name" => "Marom",
                "order" => 23,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#cd5c5c",
                "name" => "Coral",
                "order" => 24,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#cd853f",
                "name" => "Chocolate",
                "order" => 25,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#daa520",
                "name" => "Peru",
                "order" => 26,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#d2691e",
                "name" => "Chocolate",
                "order" => 27,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#ffe4b5",
                "name" => "Navajo",
                "order" => 28,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#e9967a",
                "name" => "Sienna",
                "order" => 29,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#d2b48c",
                "name" => "Bronze",
                "order" => 30,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#dc143c",
                "name" => "Bordo",
                "order" => 31,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#a9a741",
                "name" => "Oliva",
                "order" => 32,
                "status" => 1
            ]);
        ConfigColorGroup::create([ 
                "code" => "#eee8aa",
                "name" => "Nude",
                "order" => 33,
                "status" => 1
            ]);
    }
}
