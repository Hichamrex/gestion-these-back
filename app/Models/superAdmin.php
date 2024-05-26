<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\departement;
use App\Models\Laboratoire;
use App\Models\EquipeRecherche;
use App\Models\AgentRecherche;
use App\Models\AgentBibliotheque;
use App\Models\DirecteurThese;
use App\Models\Doctorant;

class superAdmin extends Model
{
    use HasFactory;

    protected $table = 'super_admins';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function departements(): HasMany
    {
        return $this->hasMany(departement::class, 'super_admin_id');
    }

    public function laboratoires(): HasMany
    {
        return $this->hasMany(Laboratoire::class, 'super_admin_id');
    }

    public function equipe_recherches(): HasMany
    {
        return $this->hasMany(EquipeRecherche::class, 'super_admin_id');
    }

    public function agent_recherches(): HasMany
    {
        return $this->hasMany(AgentRecherche::class, 'super_admin_id');
    }

    public function agent_bibliotheques(): HasMany
    {
        return $this->hasMany(AgentBibliotheque::class, 'super_admin_id');
    }

    public function directeur_these(): HasMany
    {
        return $this->hasMany(DirecteurThese::class, 'super_admin_id');
    }

    public function doctorant(): HasMany
    {
        return $this->hasMany(Doctorant::class, 'super_admin_id');
    }
}
