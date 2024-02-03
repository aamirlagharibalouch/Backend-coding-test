<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Attendanceservice;
use App\Http\Controllers\CompanyOrganizationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/attendance',function(){
    $attendance = Attendanceservice::getAttendance();
    return response()->json($attendance);
});

Route::post('/upload-attendance', [AttendanceController::class, 'uploadAttendance']);

Route::get('/findDuplicates/{myarray?}', function(Request $request, $myarray = null) {
    $arr2=[];
    if ($myarray !== null) {
        $arr2 = explode(',', @$myarray);
    }

    function findDuplicates($arr)
    {
        $seen = [];
        $duplicates = [];

        foreach ($arr as $element) {
            if (in_array($element, $seen)) {
                $duplicates[] = $element;
            } else {
                $seen[] = $element;
            }
        }

        return array_unique($duplicates);
    }

    // Example usage
    $arr = [2, 3, 1, 2, 3];
    if (isset($arr2) && count($arr2)>0) {
        $result = findDuplicates($arr2);
        $arr = $arr2;
    }else{
        $result = findDuplicates($arr);
    }

    echo "<h2>Input Array</h2>";

    echo "<pre>";
    print_r($arr);
    echo "<hr>";
    echo "<h2>Output Array</h2>";
    print_r($result);
    echo "</pre>";

});

Route::get('/group-by-owners', [CompanyOrganizationController::class, 'index']);


