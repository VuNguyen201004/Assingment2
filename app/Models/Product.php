<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Chỉ định tên bảng nếu khác với tên mặc định
    protected $table = 'products';

    // Tùy chọn nếu bảng không sử dụng timestamps
    public $timestamps = true;

    protected $fillable = ['name', 'image', 'price', 'content', 'status', 'category_id', 'luot_xem'];

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeWithCategoryName($query)
    {
        return $query->join('categories', 'products.category_id', '=', 'categories.id')
                     ->select('products.*', 'categories.name as category_name');
    }
}
