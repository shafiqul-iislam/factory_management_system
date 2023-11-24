<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use App\Models\HRM\Employee;
use Illuminate\Http\Request;
use App\Models\HRM\LeaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use Illuminate\Support\Facades\Validator;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        $data['departments'] = Department::select('id', 'name')->get();
        return view('theme.admin_portal.hrm.leave_request.all', $data);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required',
            'employee_id' => 'required',
            'finish_date' => 'required',
            'finish_date' => 'required',
            'leave_type' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addLeave = new LeaveRequest;
            $addLeave->status = ($request->status == 'on') ? 1 : 0;
            $addLeave->department_id = $request->department_id;
            $addLeave->employee_id = $request->employee_id;
            $addLeave->start_date = $request->start_date;
            $addLeave->finish_date = $request->finish_date;
            $addLeave->leave_reason = $request->leave_reason;
            $addLeave->leave_type = $request->leave_type;
            $addLeave->file = $request->file;

            $loginUserData = auth()->user();
            $addLeave->created_by_id = $loginUserData->id;
            $addLeave->created_by_username = $loginUserData->name;
            $response = $addLeave->save();

            if ($response) {
                return redirect('/leaves')->with('success', 'Successfuly Added');
            } else {
                return redirect('/leaves')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function edit($id)
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        $data['departments'] = Department::select('id', 'name')->get();        
        $data['editLeave'] = LeaveRequest::findOrFail($id);

        return view('theme.admin_portal.hrm.leave_request.edit', $data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required',
            'employee_id' => 'required',
            'finish_date' => 'required',
            'finish_date' => 'required',
            'leave_type' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateLeave = LeaveRequest::findOrFail($request->id);
            $updateLeave->status = ($request->status == 'on') ? 1 : 0;
            $updateLeave->department_id = $request->department_id;
            $updateLeave->employee_id = $request->employee_id;
            $updateLeave->start_date = $request->start_date;
            $updateLeave->finish_date = $request->finish_date;
            $updateLeave->leave_reason = $request->leave_reason;
            $updateLeave->leave_type = $request->leave_type;

            if(isset($request->file)){
                $updateLeave->file = $request->file;
            }
            
            $response = $updateLeave->save();

            if ($response) {
                return redirect('/leaves')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/leaves')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deleteLeaveRequest = LeaveRequest::findOrFail($id)->delete();
        if ($deleteLeaveRequest) {
            return redirect('/leaves')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/leaves')->with('error', 'Oops Something Wrong');
        }
    }


    // leave requests dataTables fetch by ajax
    public function serverSideAllLeaves(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = LeaveRequest::with(['departmentData', 'employeeData', 'userData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $leaves = $query->get();

        $rows = [];
        if (isset($leaves)) {
            foreach ($leaves as $leave) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('leaves/edit', [$leave->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('leaves/delete', [$leave->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $leave->id;

                if ($leave->departmentData) {
                    $td[] = $leave->departmentData->name;
                } else {
                    $td[] = '';
                }

                if ($leave->employeeData) {
                    $td[] = $leave->employeeData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $leave->leave_type;
                $td[] = $leave->start_date;
                $td[] = $leave->finish_date;
                $td[] = '';

                if ($leave->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                $td[] = date('Y-m-d', strtotime($leave->created_at));

                // created by
                if ($leave->userData) {
                    $td[] = $leave->userData->name;
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
