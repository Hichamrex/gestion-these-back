<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laboratoire;
use App\Models\AgentRecherche;
use App\Models\DirecteurThese;
use App\Models\Doctorant;

class These extends Model
{
    use HasFactory;

    protected $table = 'these';

    protected $fillable = [
        'titre',
        'date_demarrage',
        'date_publication',
        'date_soutenance',
        'agent_recherche_id',
        'laboratoire_id',
        'directeur_these_id',
        'doctorant_id',
    ];

    public function agent_recheche(): BelongsTo
    {
        return $this->belongsTo(AgentRecherche::class, 'agent_recherche_id');
    }

    public function laboratoire(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class, 'laboratoire_id');
    }

    public function doctorant(): BelongsTo
    {
        return $this->belongsTo(Doctorant::class, 'doctorant_id');
    }

    public function directeur_these(): BelongsTo
    {
        return $this->belongsTo(DirecteurThese::class, 'directeur_these_id');
    }
}
