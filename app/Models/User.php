<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    protected $connection = 'mysql';
    protected $table = 'TBG_usuario';
    protected $primaryKey = 'USUA_id';
    protected $hidden = ['remember_token'];
	public $dates = ['USUA_dt_criacao','USUA_dt_alteracao'];

    const CREATED_AT = 'USUA_dt_criacao';
    const UPDATED_AT = 'USUA_dt_alteracao';

    //campos
    public static $tabela = 'TBG_usuario';
    public static $id = 'USUA_id';
    public static $fk_terceiro = 'USUA_FK_TERC_id';
    public static $nome = 'USUA_nome';
    public static $cpf = 'USUA_cpf';
    public static $email = 'USUA_email';
    public static $tipo = 'USUA_tipo';
    public static $ativo = 'USUA_ativo';
    public static $foto = 'USUA_foto';
    public static $celular = 'USUA_celular';
    public static $senha = 'password';

    //relacionamentos
    public function Classe()
    {
        return $this->belongsToMany('App\Classe',Permissao::$tabela,Permissao::$fk_usuario,Permissao::$fk_classe)
                    ->whereHas('Sistema',function($sis)
                    {
                        $sis->where(Sistema::$codigo,env('APP_SISTEMA'));
                    });
    }
    public function UnidadeUsuario()
    {
        return $this->hasMany('App\UnidadeUsuario',UnidadeUsuario::$fk_usuario);
    }
    public function Unidades()
    {
        return $this->belongsToMany('App\UnidadeSaude',UnidadeUsuario::$tabela,UnidadeUsuario::$fk_usuario,UnidadeUsuario::$fk_unidade);
    }
    public function Permissao()
    {
        return $this->hasMany('App\Permissao',Permissao::$fk_usuario,User::$id);
    }
    public function Nucleo(){return $this->hasMany('App\UnidadeUsuario',UnidadeUsuario::$fk_usuario)->value(UnidadeUsuario::$fk_nucleo);}
    public function Unidade(){return $this->hasMany('App\UnidadeUsuario',UnidadeUsuario::$fk_usuario)->value(UnidadeUsuario::$fk_unidade);}
    public function NomeNucleo(){return $this->hasMany('App\UnidadeUsuario',UnidadeUsuario::$fk_usuario)->join(Nucleo::$tabela,UnidadeUsuario::$fk_nucleo,'=',Nucleo::$id)->value(Nucleo::$sigla);}
    public function NomeUnidade(){return $this->belongsToMany('App\UnidadeSaude',UnidadeUsuario::$tabela,UnidadeUsuario::$fk_usuario,UnidadeUsuario::$fk_unidade)->value(UnidadeSaude::$descricao);}
    public function NomeClasse(){return $this->hasMany('App\Permissao',Permissao::$fk_usuario,User::$id)->join(Classe::$tabela,Permissao::$fk_classe,'=',Classe::$id)->join(Sistema::$tabela,Classe::$fk_sistema,'=',Sistema::$id)->where(Sistema::$codigo,env('APP_SISTEMA'))->value(Classe::$descricao);}

    //atributos
    public function getId()
    {
        return $this->attributes[User::$id];
    }

    public function getFkTerceiro()
    {
        return $this->attributes[User::$fk_terceiro];
    }

    public function getNome()
    {
        return $this->attributes[User::$nome];
    }

    public function getCpf()
    {
        return $this->attributes[User::$cpf];
    }

    public function getEmail()
    {
        return $this->attributes[User::$email];
    }

    public function getTipo()
    {
        return $this->attributes[User::$tipo];
    }

    public function getAtivo()
    {
        return $this->attributes[User::$ativo];
    }

    public function getFoto()
    {
        return $this->attributes[User::$foto];
    }


    public function setFkTerceiro($valor)
    {
        $this->attributes[User::$fk_terceiro] = $valor;
    }

    public function setNome($valor)
    {
        $this->attributes[User::$nome] = $valor;
    }

    public function setCpf($valor)
    {
        $this->attributes[User::$cpf] = $valor;
    }

    public function setEmail($valor)
    {
        $this->attributes[User::$email] = $valor;
    }

    public function setTipo($valor)
    {
        $this->attributes[User::$tipo] = $valor;
    }

    public function setAtivo($valor)
    {
        $this->attributes[User::$ativo] = $valor;
    }

    public function setFoto($valor)
    {
        $this->attributes[User::$foto] = $valor;
    }

    public function setSenha($valor)
    {
        $this->attributes[User::$senha] = $valor;
    }


}
