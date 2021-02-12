<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Categoria extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'categorias';
    protected $guarded = [];

    public function searchableAs()
    {
        return 'titulo';
    }

    public function pai()
    {
        // retornar recursivamente todos os pais
        // a chamada de função with() a torna recursiva.
        // se você remover with(), ele só retorna o pai direto
        return $this->belongsTo('App\Models\Categoria', 'categoria_pai')->with('pai');
    }
    public function mae()
    {
        // retornar recursivamente todos os pais
        // a chamada de função with() a torna recursiva.
        // se você remover with(), ele só retorna o pai direto
        return $this->belongsTo('App\Models\Categoria', 'categoria_mae')->with('mae');
    }
    public function juncao()
    {
        // retornar recursivamente todos os pais
        // a chamada de função with() a torna recursiva.
        // se você remover with(), ele só retorna o pai direto
        return $this->belongsTo('App\Models\Juncao', 'juncao_id')->with('juncao');
    }

    public function filho()
    {
        //retornar recursivamente todos os filho
        // return $this->hasOne('App\Models\Categoria', 'categoria_pai')->with('filho');
        return $this->hasMany('App\Models\Categoria', 'categoria_pai')->with('filho');//->whereHas('filho');

    }

}


