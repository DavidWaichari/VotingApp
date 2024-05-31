<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Candidate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

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
        return $this->votes()->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($candidate) {
            if ($candidate->isForceDeleting()) {
                $candidate->votes()->forceDelete();
            } else {
                $candidate->votes()->delete();
            }
        });

        static::restoring(function ($candidate) {
            $candidate->votes()->withTrashed()->whereNotNull('deleted_at')->restore();
        });
    }
}
