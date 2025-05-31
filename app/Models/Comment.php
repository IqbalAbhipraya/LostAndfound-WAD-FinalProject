<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment_table';

    protected $fillable = ['comments', 'commenter_id', 'lost_items_id', 'found_items_id'];

    public function commenter()
    {
        return $this->belongsTo(User::class, 'commenter_id');
    }

    //public function lostItem()
    // {
    //     return $this->belongsTo(LostItem::class, 'lost_items_id');
    // }

    public function foundItem()
    {
        return $this->belongsTo(FoundItem::class, 'found_items_id');
    }
}