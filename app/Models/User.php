<?php

namespace App\Models;

use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'zipcode',
        'password',
        'company_name',
        'company_website',
        'user_type',
        'status',
        'last_login',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function hasActiveSubscription()
    {
        // return true;
        return optional($this->subscription)->isActive() ?? false;
    }

    public function scopeSearch($query, $find)
    {
        $search = explode(" ", $find->user);
        $total = count($search);

        $array = array();
        for($i=0; $i<$total; $i++ ) {
             if( $i == 0 ) {
                  $array = $query->where(DB::raw("CONCAT(first_name, ' ', last_name, user_type, ' ', email, ' ', status, ' ')"), "like", "%".$search[$i]."%");
              } else {
                  $array = $array->orWhere(DB::raw("CONCAT(first_name, ' ', last_name, user_type, ' ', email, ' ', status, ' ')"), "like", "%".$search[$i]."%");
              }
        }
        return $array;
    }
}
