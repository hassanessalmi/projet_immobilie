<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;
    protected $primaryKey = 'ResidenceID';

    protected $fillable = ['ResidenceName', 'ResidenceNumber'];

    // Define the relationship with apartments
    public function apartments()
    {
        return $this->hasMany(Apartement::class, 'ResidenceID');
    }
    public function reservations()
    {
        return $this->hasMany(Reserved::class, 'ResidenceID', 'ResidenceID');
    }
}
