<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MongoDB\Driver\Session;

class Invoice extends Model
{
    use HasFactory;
    use softDeletes;
    protected $guarded=[];
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
