<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
    use HasFactory;

    protected $table = 'found_item';

    protected $fillable = [
        'itemname',
        'description',
        'found_date',
        'location',
        'image',
        'founderid',
        'founder_name',
        'founder_contact',
        'claim_status',
        'claimed_at'
    ];

    protected $casts = [
        'found_date'  => 'date',
        'claimed_at'  => 'datetime',
    ];
}
