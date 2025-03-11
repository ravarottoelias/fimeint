<?php

namespace App;

use App\Notifications\PasswordReset;
use App\Traits\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'surname', 
        'email', 
        'password', 
        'documento_tipo', 
        'documento_nro', 
        'cuit', 
        'profesion', 
        'pais', 
        'provincia', 
        'codigo_tel_pais', 
        'telefono'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }

    public function inscriptions()
    {
        return $this->hasMany('App\Inscripcion');
    }

    public function hasRoles( array $roles)
    {
        foreach ($roles as $role) {
            foreach ($this->roles as $userRole) {
                if ($userRole->role === $role)
                    return true;
            }
        }
        return false;
    }

    public function estaInscriptoEn($curso_id)
    {
        $inscripcion = Inscripcion::where('user_id', $this->id)->where('curso_id', $curso_id)->first();
        if ($inscripcion)
            return true;
        
        return false;
    }

    public function getInscriptionByCursoId($cursoId)
    {
        return Inscripcion::where('user_id', $this->id)->where('curso_id', $cursoId)->first();
    }

    public function realizoPago($curso_id)
    {
        $inscripcion = Inscripcion::where('user_id', $this->id)->where('curso_id', $curso_id)->first();

        if ($inscripcion->pagado())
            return true;
        
        return false;
    }


    public function scopeName($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('name', 'like', '%'.$name.'%')->orWhere('surname', 'like', '%'.$name.'%');
        }

        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if (!is_null($email)) {
            return $query->where('email', 'like', '%'.$email.'%');
        }

        return $query;
    }

    /**
     * Get the user's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    /**
     * Get the user's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getSurnameAttribute($value)
    {
        return strtoupper($value);
    }

    public function fullName()
    {
        return strtoupper($this->surname . ' ' . $this->name);
    }

    

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

}
