<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'subject',
        'description',
        'status',
        'priority',
        'bagian'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function bagian()
    {
        return $this->belongsTo(User::class, 'bagian');
    }

    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }
}
