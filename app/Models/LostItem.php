<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $table = 'lost_items';

    protected $fillable = [
        'itemname',
        'description',
        'lost_date',
        'location',
        'image',
        'lostid',
        'lost_name',
        'lost_contact',
        'claim_status',
        'claimed_at'
    ];

    protected $casts = [
        'lost_date'  => 'date',
        'claimed_at' => 'datetime',
    ];
}