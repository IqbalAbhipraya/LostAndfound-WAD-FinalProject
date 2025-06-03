<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnReport extends Model
{
    //
    protected $table = 'return_report';

    protected $fillable = [
        'found_item_id',
        'founder_id',
        'owner_name',
        'condition',
        'image',
        'admin_acc',
    ];
}
