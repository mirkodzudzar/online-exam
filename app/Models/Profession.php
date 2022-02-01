<?php

namespace App\Models;

use App\Scopes\DestroyedAdminScope;
use App\Scopes\NewestScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\WithoutExpiredProfessionsUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Profession extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['title', 'description', 'open_date', 'close_date'];

    // This array provides abbility to show different formats of timestamp fiels in blades.
    protected $dates = ['open_date', 'close_date'];

    // Change date format of open_date field.
    public function getOpenDateAttribute($value) {
        return Carbon::parse($value)->format('d.m.Y.');
    }
    
    // Change date format of close_date field.
    public function getCloseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y.');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class)
                    ->withPivot(['total', 'attempted', 'correct', 'wrong', 'status']);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function locations()
    {
        return $this->morphToMany(Location::class, 'locationable');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function scopeWithoutExpiredProfessions(Builder $builder)
    {
        // Comparing two dates with default format
        return $builder->whereDate('close_date', '>=', Carbon::today());
    }

    public function scopeOnlyExpiredProfessions(Builder $builder)
    {
        return $builder->whereDate('close_date', '<', Carbon::today());
    }

    // Check if close_date is older than today, if so than profession is expired.
    public function isExpired()
    {
        if (Carbon::parse($this->close_date) < Carbon::today()) {
            return true;
        }

        return false;
    }

    public static function boot()
    {
        // static::addGlobalScope(new WithoutExpiredProfessionsUserScope);
        static::addGlobalScope(new NewestScope);
        static::addGlobalScope(new DestroyedAdminScope);
        
        parent::boot();
    }
}
