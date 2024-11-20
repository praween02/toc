<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeline extends Model
{
    use HasFactory;

    protected $fillable =  ['institute_id', 'equipment_id', 'equipment_dispatch_date', 'equipment_delivery_date', 'dispatch_invoice_file', 'equipment_install_date', 'equipment_commision_date', 'equipment_delivered_date', 'equipment_installed_date', 'equipment_commisioned_date'];
}
