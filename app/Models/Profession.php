<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\WithExpiredProfessionsAdminScope;
use App\Scopes\WithoutExpiredProfessionsUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'open_date', 'close_date'];

    // This array provides abbility to show different formats of timestamp fiels in blades.
    protected $dates = ['open_date', 'close_date'];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }

    public function scopeWithoutExpiredProfessions(Builder $builder)
    {
        return $builder->where('close_date', '>=', Carbon::now()->toDateTimeString());
    }

    public function scopeWithExpiredProfessions(Builder $builder)
    {
        return $builder->where('close_date', '<', Carbon::now()->toDateTimeString());
    }

    public static function boot()
    {
        // static::addGlobalScope(new WithExpiredProfessionsAdminScope);
        static::addGlobalScope(new WithoutExpiredProfessionsUserScope);
        
        parent::boot();
    }
}
