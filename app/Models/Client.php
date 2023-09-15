<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'token',
        'firstName',
        'lastName',
        'email',
        'tele',
        'commercial',
    ];
    protected static function booted()
    {
        parent::booted();

        // Automatically generate the 'token' column with "RF" prefix and a random number
        static::creating(function ($client) {
            $client->token = 'RF' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'commercial', 'id');
    }
    public function reservations()
    {
        return $this->hasMany(Reserved::class, 'clients', 'id');
    }
}
