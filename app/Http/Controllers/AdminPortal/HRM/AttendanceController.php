<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use App\Models\HRM\Employee;
use Illuminate\Http\Request;
use App\Models\HRM\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        return view('theme.admin_portal.hrm.attendances.all', $data);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'employee_id' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addDesignation = new Attendance;
            $addDesignation->employee_id = $request->employee_id;
            $addDesignation->date = $request->date;
            $addDesignation->time_in = $request->time_in;
            $addDesignation->time_out = $request->time_out;

            $loginUserData = auth()->user();
            $addDesignation->created_by_id = $loginUserData->id;
            $addDesignation->created_by_username = $loginUserData->name;
            $response = $addDesignation->save();

            if ($response) {
                return redirect('/attendances')->with('success', 'Successfuly Added');
            } else {
                return redirect('/attendances')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function edit($id)
    {
        $data['editAttendance'] = Attendance::findOrFail($id);
        $data['employees'] = Employee::select('id', 'name')->get();

        return view('theme.admin_portal.hrm.attendances.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'employee_id' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateAttendance = Attendance::findOrFail($request->id);
            $updateAttendance->employee_id = $request->employee_id;
            $updateAttendance->date = $request->date;
            $updateAttendance->time_in = $request->time_in;
            $updateAttendance->time_out = $request->time_out;
            $response = $updateAttendance->save();

            if ($response) {
                return redirect('/attendances')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/attendances')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deleteAttendance = Attendance::findOrFail($id)->delete();

        if ($deleteAttendance) {
            return redirect('/attendances')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/attendances')->with('error', 'Oops Something Wrong');
        }
    }


    // attendances dataTables fetch by ajax
    public function serverSideAllAttendances(Request $request)
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
                    <a href="' . url('attendances/edit', [$attendance->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('attendances/delete', [$attendance->id]) . '" method="POST">
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
                $td[] = '';

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
