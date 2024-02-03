<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function uploadAttendance(Request $request)
    {
        function readCSV($file) {
            $data = [];
            $handle = fopen($file, "r");

            while (($csvdata = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = ['employee_id'=>$csvdata[0], 'location_id'=>$csvdata[1], 'check_in'=>date('Y-m-d H:i:s',strtotime($csvdata[2])), 'check_out'=>date('Y-m-d H:i:s',strtotime($csvdata[3]))];
            }
            fclose($handle);
            return $data;
        }

        if($request->file('file')!=false){
            $data = readCSV($request->file('file'));
            if (isset($data) && count($data)>0) {
                $counts = 0;
                foreach ($data as $attendance) {
                    if(Attendance::insert($attendance)){
                        $counts++;
                    }
                }
            }
            $msg = "";
            if ($counts) {
                $msg = "";
            }
            return response()->json(['status' =>true, 'message' => 'Attendance data uploaded successfully'], 200);
        }else{
            return response()->json(['error' => "Excel file does not exist.",'data'=>[]], 500);
        }
    }
}
