<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';
    protected $guarded = ['id'];
    public function owner(){
        return $this->hasOne(User::class,'id','owner_id')->select('id','name','email','mobile');
    }
}
