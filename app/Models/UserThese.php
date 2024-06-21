<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laboratoire;

class UserThese extends Model
{
    use HasFactory;

    protected $table = 'user';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        "role",
        'laboratoire_id',
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }

    public function labo(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class, 'laboratoire_id');
    }

    public function theses(): HasMany
    {
        return $this->hasMany(These::class, 'agent_recherche_id');
    }

    public function thesesDirectors(): HasMany
    {
        return $this->hasMany(These::class, 'directeur_these_id');
    }

    public function thesesDoctorant(): HasMany
    {
        return $this->hasMany(These::class, 'doctorant_id');
    }

    public function thesesJurys(): BelongsToMany
    {
        return $this->belongsToMany(These::class, 'these_jury', 'jury_id', 'these_id');
    }

}
