<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'judge_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'userid';

    protected $fillable = [
        'username', 'email', 'password', 'permission', 'created_at', 'updated_at'
    ];

    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function resetPassword($userid, $newpassword){
        $sql = "UPDATE " . $this->table . " SET password = '" . bcrypt($newpassword) . "' WHERE userid = '" . $userid . "'";
        DB::update($sql);
    }
}
