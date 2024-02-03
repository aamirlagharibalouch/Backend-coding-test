<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceService extends Controller
{
    //
    public function getAttendance()
    {
        $getAttendanceData = Attendance::selectAttendance();
        $formatedData = [];

        if(isset($getAttendanceData) && count($getAttendanceData)>0){
            foreach ($getAttendanceData as $AttendanceData) {
                $calculatedTotalHours = AttendanceService::calculateTotalHours($AttendanceData);
                $checkinStatus = 'Missing';
                $checkoutStatus = 'Missing';
                
                if ($AttendanceData->check_in!=false && $AttendanceData->check_in!=null && $AttendanceData->check_in!='0000-00-00 00:00:00') {
                        $checkinStatus = date('jS M Y, H:i:a',strtotime($AttendanceData->check_in));
                }
                if ($AttendanceData->check_out!=false && $AttendanceData->check_out!=null && $AttendanceData->check_out!='0000-00-00 00:00:00') {
                        $checkoutStatus = date('jS M Y, H:i:a',strtotime($AttendanceData->check_out));
                }

                $formatedData[] = [
                                    'id'=>uniqid().''.$AttendanceData->empID,
                                    'employee'=>ucwords($AttendanceData->empname),
                                    'check_in'=>$checkinStatus,
                                    'check_out'=>$checkoutStatus,
                                    'totalhours'=>$calculatedTotalHours,
                                    ];
            }
        }
        return $formatedData;
    }

    private function calculateTotalHours($record)
    {   
        $checkIn = Carbon::parse($record->check_in);
        $checkOut = Carbon::parse($record->check_out);

        if (!$checkIn->isValid() || !$checkOut->isValid() || ($record->check_in==false || $record->check_in==null || $record->check_in=='0000-00-00 00:00:00') || ($record->check_out==false || $record->check_out==null || $record->check_out=='0000-00-00 00:00:00') ) {
            return 'N/A';
        }

        if ($checkIn->isValid() && $checkOut->isValid() ) {
            $totalHours = $checkOut->diffInHours($checkIn);
            return number_format($totalHours, 2);
        } else {
            return 'N/A';
        }
    }
}
