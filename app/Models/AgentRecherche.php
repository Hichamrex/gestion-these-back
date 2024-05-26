<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\superAdmin;
use App\Models\These;

class AgentRecherche extends Model
{
    use HasFactory;

    protected $table = 'agent_recherche';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        "role",
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }

    public function theses(): HasMany
    {
        return $this->hasMany(These::class, 'agent_recherche_id');
    }

}
