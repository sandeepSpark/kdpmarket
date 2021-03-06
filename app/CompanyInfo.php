<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class CompanyInfo extends Authenticatable
{
    use Notifiable;

    protected $guard = 'companies';
    protected $table = 'companies_info';

    protected $fillable = [
        'company_name','company_phone','company_email','center_qualify'
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function members()
    {
        // return $this->belongsTo('App\Member');
        return $this->belongsTo('App\Member', 'member_id');
        
    }
}
