<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Election extends Model
{
    use HasFactory;

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
        if ($vote) {
            return true;
        }
        return false;
    }
}
