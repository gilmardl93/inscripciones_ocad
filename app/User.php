<?php

namespace App;

use App\Models\Catalogo;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dni', 'email', 'password','foto','activo','idrole','menu'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];
    /**
     * Atributos de la clase Users
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    /**
    * Atributos Foto
    */
    public function getMostrarFotoAttribute()
    {
        $foto = asset('/storage/'.$this->foto);
        return $foto;
    }
    /**
    * Atributos Rol
    */
    public function getCodigoRolAttribute()
    {
        $role = Catalogo::find($this->idrole);
        return $role->codigo;
    }
    /**
     * Atributos Idrole
     */
    public function setIdroleAttribute($value)
    {
        $rol = Catalogo::where('id',$value)->first();
        switch ($rol->nombre) {
            case 'Alumno':
                $this->attributes['menu'] = null;
                break;
            default:
                $this->attributes['menu'] = 'menu.sider-admin';
                break;
        }
        $this->attributes['idrole'] = $value;
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function role()
    {
        return $this->hasOne('\App\Models\Catalogo','id','idrole');
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $name = $this->name;
        $this->notify(new ResetPassword($token,$name));
    }



}
