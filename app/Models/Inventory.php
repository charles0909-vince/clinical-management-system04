<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'quantity',
        'unit',
        'price',
        'supplier',
        'reorder_level',
        'expiry_date'
    ];

    protected $table = 'inventories';

    protected $casts = [
        'expiry_date' => 'date'
    ];
}