<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;

class Company extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_account','company_name','email', 'password','company_address','postalcode','business_licence','organization_code','activated'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function own()
    {
        return $this->hasMany(Relation::class,'company')->where('state',0);
    }

    public function find_audit()
    {
        $user_ids=Auth::company()->get()->own->pluck('user')->toArray();
        return User::whereIn('id',$user_ids);
    }

    public function relations()
    {
        //一对多（“一”属于上层模型）
        //hasMany第一个参数：对应的模型类
        //第二个参数：（可选）外键名称，默认‘对应上层模型类_id’,否则需要重写外键
        //第三个参数：（可选）上层模型本地键,默认‘id’，否则自定义本地键
        return $this->hasMany('App\Models\Relation','company');
    }
}
