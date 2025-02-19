<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'user_id',
        'aksi'
    ];

    protected $casts = [
        'ticket_id' => 'integer',
        'user_id' => 'integer',
    ];

    // Relasi ke tiket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relasi ke user yang melakukan aksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
