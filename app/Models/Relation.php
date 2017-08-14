<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Company;

class Relation extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'relation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user','company','state','reason'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function get_company_name($company)
    {
        $company=Company::findOrFail($company);
        return $company->company_name;
    }

    public function companys()
    {
        //多对一（“一”属于上层模型）
        //belongsTo第一个参数：对应的模型类
        //第二个参数：（可选）外键名称，默认‘对应上层模型类_id’,否则需要重写外键
        //第三个参数：（可选）上层模型本地键,默认‘id’，否则自定义本地键
        return $this->belongsTo('App\Models\Company','company');
    }
}
