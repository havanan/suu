<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['total','images'];
    public function getTotalAttribute(){
        return $this->hasMany(StockProduct::class,'product_id','id')->sum('total');
    }
    public function child(){
        return $this->hasMany(Product::class,'parent_id','id');
    }
    public function stocks(){
        return $this->hasMany(StockProduct::class,'product_id','id');
    }
    public function getImagesAttribute(){

        if ($this->parent_id){
            $images = $this->image != null ?  json_decode($this->image,true) : [];
            return !empty($images) ? $images[0] : null;
        }
        return $this->image != null ?  json_decode($this->image,true) : [];
    }
}
