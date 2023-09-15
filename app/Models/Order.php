<?php

namespace App\Models;

use App\Models\Apartement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable = [
        'clients', // Correspond au nom de la colonne 'clients'
        'Details', // Correspond au nom de la colonne 'Details'
        'ApartmentsID', // Correspond au nom de la colonne 'ApartmentsID'
        'commercial', // Correspond au nom de la colonne 'commercial'
        'finalPrice', // Correspond au nom de la colonne 'finalPrice'
        // D'autres attributs fillable si nécessaire
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartement::class, 'ApartmentsID', 'ApartmentsID');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'clients');
    }
    public function residence()
{
    return $this->belongsTo(Residence::class, 'ResidenceID');
}
public function commerciall()
{
    return $this->belongsTo(User::class, 'commercial');
}

}
