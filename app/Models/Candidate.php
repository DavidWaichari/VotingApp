<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Candidate extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'election_id'
    ];

    protected $appends = ['image_url', 'no_of_votes'];


    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id');
    }
    
    public function votes()
    {
        return $this->hasMany(Vote::class, 'candidate_id');
    }

    protected function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl();
    }

    public function getNoOfVotesAttribute()
    {
        return $this->votes->count();
    }
}
