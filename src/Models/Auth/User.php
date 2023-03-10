<?php

namespace Illegal\Linky\Models\Auth;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Traits\HasLinkyTablePrefix;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
     * Send the password reset notification.
     * Overriding the default implementation to use the linky custom URL.
     *
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $notification = new ResetPasswordNotification($token);

        $notification::$createUrlCallback = function ($notifiable, $token) {
            return url(route('linky.auth.password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        };

        $this->notify($notification);
    }

    /**
     * Send the email verification notification.
     * Overriding the default implementation to use the linky custom URL.
     *
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        if(!config('linky.auth.functionalities.email_verification')) {
            return;
        }

        $notification = new VerifyEmail;

        $notification::$createUrlCallback = function ($notifiable) {
            return URL::temporarySignedRoute(
                'linky.auth.verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        };

        $this->notify($notification);
    }
}
