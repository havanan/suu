<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'product_category';

    public function child(){
        return $this->hasMany(ProductCategory::class,'parent_id','id');
    }
}
