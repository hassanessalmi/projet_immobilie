<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartement extends Model
{
    use HasFactory;
    protected $primaryKey = 'ApartmentsID';

    protected $fillable = ['ApartmentsNumber', 'SizeParSquareMeter', 'PriceParSquareMeter', 'TotalPrice', 'Status', 'ResidenceID'];

    // Define the relationship with residence
    public function residence()
    {
        return $this->belongsTo(Residence::class, 'ResidenceID');
    }
    public function reservations()
{
    return $this->hasMany(Reserved::class, 'ApartmentsID', 'ApartmentsID');
}
}
