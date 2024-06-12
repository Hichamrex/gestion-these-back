<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Laboratoire;
// use App\Models\AgentRecherche;
use App\Models\UserThese;
use App\Models\DirecteurThese;
use App\Models\Doctorant;
use App\Models\ThesesFiles;

class These extends Model
{
    use HasFactory;

    protected $table = 'these';

    protected $fillable = [
        'titre',
        'sujet',
        'duree',
        'date_publication',
        'date_soutenance',
        'agent_recherche_id',
        'laboratoire_id',
        'directeur_these_id',
        'doctorant_id',
    ];

    public function agent_recheche(): BelongsTo
    {
        return $this->belongsTo(UserThese::class, 'agent_recherche_id');
    }

    public function laboratoire(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class, 'laboratoire_id');
    }

    public function doctorant(): BelongsTo
    {
        return $this->belongsTo(UserThese::class, 'doctorant_id');
    }

    public function directeur_these(): BelongsTo
    {
        return $this->belongsTo(UserThese::class, 'directeur_these_id');
    }

    public function files() : HasMany
    {
        return $this->hasMany(ThesesFiles::class, 'these_id');
    }
}
