<?php

namespace App\Models;

use App\Models\{Country,State,City,SixGUserCollaborator};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SixGUser extends Model
{
    use HasFactory;

    protected $table = '6g_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['collaborator_name', 'collaborator_designation', 'collaborator_contact_no', 'collaborator_email_id', 'collaborator_industry_cateogory', 'collaborator_address', 'collaborator_biodata', 'collaborator_area_of_work', 'collaborator_size_company', 'collaborator_location_of_head_office_branch', 'collaborator_company_turnover', 'collaborator_company_turnover_attachment'];



    public function country_name() {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function state_name() {
        return $this->belongsTo(State::class, 'state', 'id');
    }

    public function city_name() {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function collaborators() {
        return $this->hasMany(SixGUserCollaborator::class, 'application_id', 'id');
    }

}
