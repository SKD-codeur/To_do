<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tache extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'date',
        'heures',
        'user_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
