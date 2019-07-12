
<?php

use Illuminate\Database\Seeder;
use AVDPainel\Models\Admin\ConfigFreight;

class ConfigFreightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        ConfigFreight::create([
            'declare' => 1,
            'default' => 1,
            'weight' => 1,
            'width' => 0,
            'height' => 0,
            'length' => 0,
            'created_at' => $date
        ]);
    }
}