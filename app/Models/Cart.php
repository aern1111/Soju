<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'quantity',
        'total',
        'category',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function users(){
        return $this->belongsTo('App\Models\User','user_id')->select(['id','firstName','lastName']);
    }
}
