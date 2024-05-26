<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\departement;
use App\Models\superAdmin;
use App\Models\These;

class Laboratoire extends Model
{
    use HasFactory;

    protected $table = 'laboratoire';


    protected $fillable = [
        'name',
        'departement_id',
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }

    public function departement(): BelongsTo
    {
        return $this->belongsTo(departement::class, 'departement_id');
    }

    public function theses(): HasMany
    {
        return $this->hasMany(These::class, 'laboratoire_id');
    }
}
