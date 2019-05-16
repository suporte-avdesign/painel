<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigPage;
use AVDPainel\Models\Admin\ConfigTemplate;

class CreateConfigPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        //Page Home
        ConfigPage::create([
            'id' => 1,
            'name' => 'Home',
            'module' => 'home',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        //Modules Home
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Slider',
            'module' => 'slider',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Banner',
            'module' => 'banner',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Ofertas',
            'module' => 'offer',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Novos',
            'module' => 'new',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Destaques',
            'module' => 'featured',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Seções',
            'module' => 'section',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Categorias',
            'module' => 'category',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 1,
            'tmp' => 1,
            'name' => 'Marcas',
            'module' => 'brand',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        // Page Sections
        ConfigPage::create([
            'id' => 2,
            'name' => 'Seções',
            'module' => 'sections',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        //Modules Sections
        ConfigTemplate::create([
            'config_page_id' => 2,
            'tmp' => 1,
            'name' => 'Seção',
            'module' => 'section',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        //Page Categories
        ConfigPage::create([
            'id' => 3,
            'name' => 'Categorias',
            'module' => 'categories',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        //Modules Categories
        ConfigTemplate::create([
            'config_page_id' => 3,
            'tmp' => 1,
            'name' => 'Categoria',
            'module' => 'category',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        //Page Products
        ConfigPage::create([
            'id' => 4,
            'name' => 'Produtos',
            'module' => 'products',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        //Modules Products
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Produto',
            'module' => 'product',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Banner',
            'module' => 'banner',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Ofertas',
            'module' => 'offer',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Destaques',
            'module' => 'featured',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Tabs',
            'module' => 'tab',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Descrição',
            'module' => 'description',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Comentários',
            'module' => 'review',
            'status' => 'Ativo',
            'created_at' => $date
        ]);
        ConfigTemplate::create([
            'config_page_id' => 4,
            'tmp' => 1,
            'name' => 'Relacionados',
            'module' => 'related',
            'status' => 'Ativo',
            'created_at' => $date
        ]);

    }
}
