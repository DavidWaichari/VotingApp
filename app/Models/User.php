<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Vote;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'id_number',
        'member_number',
        'phone_number',
        'is_admin',
        'email',
        'otp',
        'password',
        'can_vote'
    ];

    protected $appends = ['has_voted'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @v# code...ar array<int, string>
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
    ];

    public function getHasVotedAttribute()
    {
        $votes = Vote::where('user_id', $this->id)->count();
        if ($votes > 0) {
            return true;
        }
        return false;
    }
}
