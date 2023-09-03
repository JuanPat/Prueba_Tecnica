<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;


class Cuenta extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'cuentas';

    protected $fillable = ['nombre', 'email', 'telefono'];

    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }
}
