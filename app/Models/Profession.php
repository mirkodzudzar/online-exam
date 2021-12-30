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

class Profession extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->belongsToMany(Candidate::class);
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

    public static function boot()
    {
        // static::addGlobalScope(new WithoutExpiredProfessionsUserScope);
        static::addGlobalScope(new NewestScope);
        static::addGlobalScope(new DestroyedAdminScope);
        
        parent::boot();
    }
}
