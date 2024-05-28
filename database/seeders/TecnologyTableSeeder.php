<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnology;
use App\Models\Type;
use App\Functions\Helper as Help;

class TecnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['HTML', 'CSS', 'PHP', 'JAVASCRIPT', 'PYTHON'];
        foreach ($data as $item) {
            $new_item = new Tecnology();
            $new_item->title = $item;
            $new_item->slug = Help::generateSlug($item, Tecnology::class);
            $new_item->save();
        }
    }
}
