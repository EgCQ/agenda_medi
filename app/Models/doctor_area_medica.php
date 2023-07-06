<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor_area_medica extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_doctor',
        'id_area_medica',
    ];
    // public static function doctor_area($id){
    //     return doctor_area_medica::where('id_area_medica', '=', $id)->get();
    // }
}
