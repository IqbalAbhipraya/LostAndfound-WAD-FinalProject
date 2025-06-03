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
        'userid',
        'lost_name',
        'lost_contact',
        'claim_status',
        'claimed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'lost_items_id');
    }


    // protected $casts = [
    //     'lost_date'  => 'date',
    //     'claimed_at' => 'datetime',
    // ];
}