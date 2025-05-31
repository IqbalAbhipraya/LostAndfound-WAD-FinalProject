<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnReport extends Model
{
    //
    protected $table = 'return_report';

    protected $fillable = [
        'owner_name',
        'condition',
        'image',
        'admin_acc',
    ];
}
