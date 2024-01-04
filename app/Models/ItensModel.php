<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItensModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'itens';

    protected $fillable = [
        'nome',
        'status',
        'previsao',
        'conclusao',
        'lista_id'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function lista(){
        return $this->belongsTo(ListasModel::class, 'lista_id');
    }
}
