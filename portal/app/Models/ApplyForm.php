<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyForm extends Model
{
	protected $table = 'apply_forms';
	
    use HasFactory;

    protected $fillable = 
    [
    'company_name', 
    'cin_number',
    'regd_office_address',
    'corp_office_address',
    'company_website',
    'mse_type',
    'mse_certificate',
    'name',
    'designation',
    'contact_no',
    'email_id',
    'cheque_no',
    'amount',
    'issue_date',
    'issue_branch',
    'payment_mode',
    'solution_name',
    'solution_designed_for',
    'solution_compiles_to',
    'solution_source',
    'solution_telecom',
    'solution_testing',
    'solution_mse_type',
    'solution_mse_certificate',
    'bsnl_voltage',
    'bsnl_current',
    'bsnl_space',
    'bsnl_port',
    'bsnl_bandwidth',
    'bsnl_testing_location',
    'requirements',
    'signature',
    'cert_incorporation',
    'cert_self_declaration',
    'cert_self_declaration_lab',
    'cert_draft',
    'cert_ownership'
    ];
}
