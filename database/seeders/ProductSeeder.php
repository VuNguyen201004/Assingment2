<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy ID của các danh mục từ bảng categories
        $lenovoCategoryId = DB::table('categories')->where('name', 'Lenovo')->value('id');
        $macbookCategoryId = DB::table('categories')->where('name', 'MacBook')->value('id');
        $dellCategoryId = DB::table('categories')->where('name', 'Dell')->value('id');
        $asusCategoryId = DB::table('categories')->where('name', 'ASUS')->value('id');

        // Seed sản phẩm cho các danh mục máy tính
        DB::table('products')->insert([
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'image' => 'lenovo-thinkpad.jpg',
                'price' => 1899.99,
                'content' => 'Mô tả sản phẩm Lenovo ThinkPad X1 Carbon.',
                'status' => 1,
                'category_id' => $lenovoCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MacBook Pro 13-inch',
                'image' => 'macbook-pro.jpg',
                'price' => 2299.99,
                'content' => 'Mô tả sản phẩm MacBook Pro 13-inch.',
                'status' => 1,
                'category_id' => $macbookCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell XPS 15',
                'image' => 'dell-xps.jpg',
                'price' => 1799.99,
                'content' => 'Mô tả sản phẩm Dell XPS 15.',
                'status' => 1,
                'category_id' => $dellCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ASUS ZenBook 14',
                'image' => 'asus-zenbook.jpg',
                'price' => 1299.99,
                'content' => 'Mô tả sản phẩm ASUS ZenBook 14.',
                'status' => 1,
                'category_id' => $asusCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các sản phẩm máy tính khác tại đây
        ]);
    }
}
