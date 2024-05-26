<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\superAdmin;
use App\Models\These;

class DirecteurThese extends Model
{
    use HasFactory;

    protected $table = 'directeur_these';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }

    public function theses(): HasMany
    {
        return $this->hasMany(These::class, 'directeur_these_id');
    }
}
