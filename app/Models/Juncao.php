<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juncao extends Model
{
    use HasFactory;
    protected $table = 'juncao';
    protected $guarded = [];

    public function pai()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'cat_pai'); //->whereHas('filho');

    }
    public function mae()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'cat_mae'); //->whereHas('filho');

    }

    public function filhos()
    {
        //retornar recursivamente todos os filhos
        // return $this->hasOne('App\Models\Categoria', 'categoria_pai')->with('filho');
        return $this->hasMany('App\Models\Categoria', 'juncao_id')->with('filhos'); //->whereHas('filho');

    }

}
