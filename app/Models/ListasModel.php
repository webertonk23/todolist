<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListasModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'listas';

    protected $fillable = [
        'nome'
    ];

    public function itens(){
        return $this->hasMany(ItensModel::class, 'lista_id');
    }
}
