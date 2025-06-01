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
        'location',
        'found_date',
        'image',
        'founderid',
        'founder_name',
        'founder_contact',
        'claim_status',
        'claimed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'founderid');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'found_items_id');
    }

    // protected $casts = [
    //     'found_date'  => 'date',
    //     'claimed_at'  => 'datetime',
    // ];
}
