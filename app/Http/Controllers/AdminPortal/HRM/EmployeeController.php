<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use App\Models\HRM\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.hrm.employees.all');
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:employees',
            'name' => 'required',
            'phone' => 'required|unique:employees',
            'department_id' => 'required',
            'designation' => 'required',
            'joining_date' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addEmployee = new Employee;
            $addEmployee->department_id = $request->department_id;
            $addEmployee->designation = $request->designation;
            $addEmployee->name = $request->name;
            $addEmployee->username = $request->username;
            $addEmployee->phone = $request->phone;
            $addEmployee->email = $request->email;
            $addEmployee->gender = $request->gender;
            $addEmployee->address = $request->address;
            $addEmployee->joining_date = $request->joining_date;
            $addEmployee->office_shift = $request->office_shift;
            $addEmployee->status = ($request->status == 'on') ? 1 : 0;

            $loginUserData = auth()->user();
            $addEmployee->created_by_id = $loginUserData->id;
            $addEmployee->created_by_username = $loginUserData->name;
            $response = $addEmployee->save();

            if ($response) {
                return redirect('/employees')->with('success', 'Successfuly Added');
            } else {
                return redirect('/employees')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function edit($id)
    {
        $editEmployee = Employee::findOrFail($id);
        return view('theme.admin_portal.hrm.employees.edit', ['editEmployee' => $editEmployee]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', Rule::unique('employees')->ignore($request->id)],
            'phone' => ['required', Rule::unique('employees')->ignore($request->id)],
            'name' => 'required',
            'department_id' => 'required',
            'designation' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateEmployee = Employee::findOrFail($request->id);
            $updateEmployee->department_id = $request->department_id;
            $updateEmployee->designation = $request->designation;
            $updateEmployee->name = $request->name;
            $updateEmployee->username = $request->username;
            $updateEmployee->phone = $request->phone;
            $updateEmployee->email = $request->email;
            $updateEmployee->gender = $request->gender;
            $updateEmployee->dob = $request->dob;
            $updateEmployee->address = $request->address;
            $updateEmployee->country = $request->country;
            $updateEmployee->joining_date = $request->joining_date;
            $updateEmployee->office_shift = $request->office_shift;
            $updateEmployee->country = $request->country;
            $updateEmployee->status = ($request->status == 'on') ? 1 : 0;
            $response = $updateEmployee->save();

            if ($response) {
                return redirect('/employees')->with('success', 'Successfuly Added');
            } else {
                return redirect('/employees')->with('error', 'Oops Something Wrong');
            }

            if ($response) {
                return redirect('/departments')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/departments')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deleteEmployee = Employee::findOrFail($id)->delete();

        if ($deleteEmployee) {
            return redirect('/employees')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/employees')->with('error', 'Oops Something Wrong');
        }
    }


    // employees dataTables fetch by ajax
    public function serverSideAllEmployees(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Employee::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $employees = $query->get();

        $rows = [];
        if (isset($employees)) {
            foreach ($employees as $employee) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('employees/edit', [$employee->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('employees/delete', [$employee->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $employee->id;
                $td[] = $employee->name;
                $td[] = $employee->phone;

                if ($employee->gender == 1) {
                    $td[] = 'Male';
                } else if ($employee->gender == 2) {
                    $td[] = 'Female';
                } else {
                    $td[] = 'Others';
                }

                $td[] = $employee->designation;
                $td[] = $employee->department_id;
                $td[] = $employee->office_shift;

                if ($employee->status == 1) {
                    $td[] = '<span class="text-success fw-bolder">Active</span>';
                } else {
                    $td[] = '<span class="text-danger fw-bolder">Deactive</span>';
                }
                $td[] =  date('Y-m-d', strtotime($employee->joining_date));

                // created by
                if ($employee->userData) {
                    $td[] = $employee->userData->name;
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
