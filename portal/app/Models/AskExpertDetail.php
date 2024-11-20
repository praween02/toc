<?php

namespace App\Models;

use App\Models\{City,State,Country,Expertise};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskExpertDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nationality_data() {
        return $this->belongsTo(Country::class, 'nationality', 'id')->select('name');
    }

    public function city_data() {
        return $this->belongsTo(City::class, 'city', 'id')->select('name');
    }

    public function state_data() {
        return $this->belongsTo(State::class, 'state', 'id')->select('name');
    }

    public function country_data() {
        return $this->belongsTo(Country::class, 'country', 'id')->select('name');
    }

    public function activity_data() {
        return $this->belongsTo(Expertise::class, 'activity', 'id')->select('expertise');
    }

    

}
