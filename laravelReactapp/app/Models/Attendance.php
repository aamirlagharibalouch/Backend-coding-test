<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    use HasFactory;

    public function selectAttendance()
    {
        return DB::table('employees')
        ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
        ->join('locations', 'locations.id', '=', 'attendances.location_id')
        ->select('employees.name as empname', 'employees.id as empID', 'attendances.*', 'locations.name as locationName')
        ->orderBy('attendances.check_in', 'desc')
        ->orderBy('attendances.check_out', 'desc')
        ->orderBy('attendances.id', 'desc')
        ->get();

    }

}
