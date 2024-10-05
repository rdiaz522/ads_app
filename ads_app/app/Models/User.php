<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const LOGIN_STATUS = 'active';

    protected $table = 'users';

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'middlename',
        'lastname',
        'username',
        'email',
        'user_type',
        'gender',
        'login_status',
        'email_verified_at',
        'remember_token',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'subdomain_id'
    ];

    protected $appends = ['fullname'];

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
        'password' => 'hashed',
        'fullname' => 'string'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    protected static function booted(): void
    {
        static::saving(static function ($model) {
            $userId = auth()->id() ?? config('custom.system_user_id');
            if ($model->exists) {
                $model->updated_by = $userId;
            } else {
                if (isEmpty($model->id)) {
                    $model['id'] = generateGUID();
                }
                if (isEmpty($model->login_status)) {
                    $model['login_status'] = self::LOGIN_STATUS;
                }
                if (isEmpty($model->created_by)) {
                    $model['created_by'] = $userId;
                }
                if (isEmpty($model->updated_by)) {
                    $model['updated_by'] = $userId;
                }

                if (!isEmpty($model->password) && !isBcryptHashed($model->password)) {
                    $model->password = Hash::make($model->password);
                }
            }
        });
    }



    //------------------ ACCESSORS---------------------//

    /**
     * Accessor Full Name
     * Combined the Firstname and Lastname
     * 
     * @return void
     */
    protected function getFullnameAttribute()
    {
        $firstName = ucfirst($this->firstname);
        $lastName = ucfirst($this->lastname);

        return "{$firstName} {$lastName}";
    }

    /**
     * Accessor Firstname
     * 
     * Uppercase First Letter
     *
     * @return Attribute
     */
    protected function firstname(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
        );
    }

    /**
     * Accessor Lastname
     * 
     * Uppercase First Letter
     *
     * @return Attribute
     */
    protected function lastname(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
        );
    }

    /**
     * Accessor Middlename
     * 
     * Uppercase First Letter
     *
     * @return Attribute
     */
    protected function middlename(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
        );
    }


    /**
     * Accessor for Created At
     * 
     * Format as Y-m-d H:i:s
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->setTimezone(config('custom.timezone'))->format('Y-m-d H:i:s'),
        );
    }

    //  /**
    //  * Accessor for Created At
    //  * 
    //  * Format as Y-m-d H:i:s
    //  *
    //  * @return Attribute
    //  */
    // protected function createdBy(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(string $value) => ,
    //     );
    // }
}
