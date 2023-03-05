<?php

namespace Illegal\Linky\Models\Auth;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasLinkyTablePrefix;

    /**
     * @var string $tableName The table associated with the model.
     */
    protected string $tableName = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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

    protected static function boot()
    {
        self::deleting(function ($user) {
            /**
             * Delete all tokens associated with the user.
             */
            $user->tokens()->delete();

            /**
             * Delete all contents owned by the user.
             */
            $user->contents->map(function ($content) {
                $content->delete();
            });
        });
        parent::boot();
    }

    /**
     * Contents owned by the user.
     *
     * @return HasMany
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * @todo To be implemented.
     *
     * @param $token
     * @return true
     */
    public function sendPasswordResetNotification($token)
    {
        return true;
    }

    /**
     * @todo To be implemented.
     *
     * @return true
     */
    public function sendEmailVerificationNotification()
    {
        return true;
    }
}
