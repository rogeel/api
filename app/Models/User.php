<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model  implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract, Transformable
{
    use  SoftDeletes, Authenticatable, CanResetPassword, HasRoleAndPermission, TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'jugadores';

    protected $primaryKey = "id_jugador";

    protected $fillable = [
        'nombres', 'apellidos', 'email', 'id_posicion', 'id_ciudad', 'f_nacimiento', 'zona', 'password', 'descripcion', 'logros', 'fuerza', 'defensa', 'resistencia', 'tecnica','ataque','remember_token','token_facebook','movil','confirmed', 'confirmation_code','app'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];






    public function posicion()
    {
      return $this->BelongsTo('App\Models\Posiciones', 'id_posicion', 'id_posicion');
    }

    public function ciudad()
    {
      return $this->BelongsTo('App\Models\Ciudades', 'id_ciudad', 'id_ciudad');
    }

    public function zona()
    {
      return $this->BelongsTo('App\Models\Zonas', 'zona', 'id_zona');
    }


  /**
   * Returns the complete name of the user
   * @return String Contains the first_name and last_name of the user
   */
    public function full_name(){
      return $this->nombres." ".$this->apellidos;
    }

}
