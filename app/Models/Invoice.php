<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    // softDelete
    use SoftDeletes;
    protected $guarded=[
        "id","created_at","updated_at"
    ];
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
