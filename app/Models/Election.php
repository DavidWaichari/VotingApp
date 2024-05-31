<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Election extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'position_name',
        'maximum_selections',
        'started_at',
        'ended_at',
        'is_active',
    ];

    protected $appends = ['auth_user_has_voted'];

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'election_id');
    }

    public function getAuthUserHasVotedAttribute()
    {
        $vote = Vote::where('election_id', $this->id)->where('user_id', Auth::user()->id)->first();
        return $vote ? true : false;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($election) {
            foreach ($election->candidates as $candidate) {
                if ($election->isForceDeleting()) {
                    $candidate->votes()->forceDelete();
                    $candidate->forceDelete();
                } else {
                    $candidate->votes()->delete();
                    $candidate->delete();
                }
            }
        });

        static::restoring(function ($election) {
            $election->candidates()->withTrashed()->whereNotNull('deleted_at')->restore();
            foreach ($election->candidates()->withTrashed()->get() as $candidate) {
                $candidate->votes()->withTrashed()->whereNotNull('deleted_at')->restore();
            }
        });
    }
}
