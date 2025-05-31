// app/Models/Feedback.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari nama model (plural)
    protected $table = 'feedback'; // Opsional, defaultnya sudah 'feedback'

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}