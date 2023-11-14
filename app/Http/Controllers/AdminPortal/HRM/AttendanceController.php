<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HRM\Attendance;
use App\Models\HRM\Employee;

class AttendanceController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        return view('theme.admin_portal.hrm.attendances.all', $data);
    }


    // designations dataTables fetch by ajax
    public function serverSideAllDesignations(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Attendance::with(['employeeData', 'userData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $attendances = $query->get();

        $rows = [];
        if (isset($attendances)) {
            foreach ($attendances as $attendance) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('designations/edit', [$attendance->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('designations/delete', [$attendance->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $attendance->id;

                if ($attendance->employeeData) {
                    $td[] = $attendance->employeeData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $attendance->date;
                $td[] = $attendance->time_in;
                $td[] = $attendance->time_out;

                // created by
                if ($attendance->userData) {
                    $td[] = $attendance->userData->name;
                } else {
                    $td[] = '';
                }
                $td[] = $actions;
                $rows[] = $td;
            }
            $json_data = array(
                "draw" => intval($request->draw),
                "recordsTotal" => intval($totalRecords),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $rows,
            );
            echo json_encode($json_data);
        }
    }
}
