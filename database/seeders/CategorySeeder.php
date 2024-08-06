<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Lenovo', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MacBook', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dell', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ASUS', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            // Thêm các danh mục máy tính khác tại đây
        ]);
    }
}
