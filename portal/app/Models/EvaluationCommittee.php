<?php

namespace App\Models;

use App\Models\{EvaluationCommitteeExpert, AskExpertDetail};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\{HasManyThrough};

class EvaluationCommittee extends Model
{
    use HasFactory;

    protected $table = 'evaluation_committees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team',
    ];

    public function experts(): HasManyThrough {
        return $this->hasManyThrough(AskExpertDetail::class, EvaluationCommitteeExpert::class, 'evaluation_committee_id', 'user_id', 'id' , 'expert_id')->select('first_name');
    }

}
