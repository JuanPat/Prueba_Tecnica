<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;


class Pedido extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'pedidos';

    protected $fillable = ['cuenta_id', 'producto', 'cantidad', 'valor', 'total'];

    public function cuenta() {
        return $this->belongsTo(Post::class);
    }
}
