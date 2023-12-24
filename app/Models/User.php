<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User\OtpCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'phone_number',
        'phone_verified_at',
        'email_verified_at',
        'national_code',
        'image',    
        'is_admin',
        'is_staff',
        'is_active',
        'is_banned',
        'email',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', 0);
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function setEmailVerifiedAtAttribute($verified_at)
    {
        $this->attributes['email_verified_at'] = date("Y-m-d H:i:s", time());
    }

    public function setPhoneVerifiedAtAttribute($verified_at)
    {
        $this->attributes['phone_verified_at'] = date("Y-m-d H:i:s", time());
    }

    public function generateOtpCode()
    {
        $currentOtpCode = $this->otpCodes()->hasExpired()->first();

        if (empty($currentOtpCode)) {
            $this->otpCodes()->delete();
            do {
                $newCode = mt_rand(10000, 99999);
            } while ($this->checkUniqueCode($newCode));
    
            $newOtpCode = $this->otpCodes()->create([
                'code'          =>  $newCode,
                'expired_at'    =>  now()->addSeconds(config('auth.resend_otp_time')),
            ]);

            return $newOtpCode;
        }

        return $currentOtpCode;
    }

    private function checkUniqueCode(int $code)
    {
        return !!$this->otpCodes()->whereCode($code)->first();
    }

    public function hasActiveOtpCode()
    {
        return $this->otpCodes()->where('expired_at', ">", now())->exists();
    }

    public function getActiveOtpCode()
    {
        return $this->otpCodes()->where('expired_at', ">", now())->first();
    }


    public function userCanLoginOtp() 
    { 
        if ($this->is_admin || $this->is_staff) {
            if (!config('auth.admin_can_login_otp')) {
                return false;
            }
        }

        return true;
    }

    // relations
    public function otpCodes() 
    {
        return $this->hasMany(OtpCode::class);
    }

}
