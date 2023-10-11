<?php

namespace App\Http\Controllers\AdminPortal\Department;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    public function index()
    {
        return view('theme.admin_portal.departments.all');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addDepartment = new Department;
            $addDepartment->name = $request->name;
            $addDepartment->description = $request->description;
            $addDepartment->status = ($request->status == 'on') ? 1 : 0;

            $loginUserData = auth()->user();
            $addDepartment->created_by_id = $loginUserData->id;
            $addDepartment->created_by_username = $loginUserData->name;
            $response = $addDepartment->save();

            if ($response) {
                return redirect('/departments')->with('success', 'Successfuly Added');
            } else {
                return redirect('/departments')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function view($id)
    {
        $viewDepartment = Department::with(['userData'])->find($id);

        return view('theme.departments.view', ['viewDepartment' => $viewDepartment]);
    }


    public function edit($id)
    {
        $editDepartment = Department::find($id);

        return view('theme.departments.edit', ['editDepartment' => $editDepartment]);
    }


    public function update(Request $request)
    {
        $validator = $request->validate([
            'department_name' => 'required',
            'description' => 'required',
        ]);

        $updateDepartment = Department::find($request->id);
        $updateDepartment->name = $request->name;
        $updateDepartment->description = $request->description;
        $updateDepartment->status = ($request->status == 'on') ? 1 : 0;
        $response = $updateDepartment->save();

        if ($response) {
            return redirect('/departments')->with('success', 'Successfuly Updated');
        } else {
            return redirect('/departments')->with('error', 'Oops Something Wrong');
        }
    }


    public function delete($id)
    {
        $deleteDepartment = Department::find($id)->delete();

        if ($deleteDepartment) {
            return redirect('/departments')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/departments')->with('error', 'Oops Something Wrong');
        }
    }

    // department dataTables fetch by ajax
    public function serverSideAlldepartments(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Department::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $departments = $query->get();

        $rows = [];
        if (isset($departments)) {
            foreach ($departments as $department) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('departments/edit', [$department->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('departments/delete', [$department->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $department->id;
                $td[] = $department->name;
                $td[] = $department->description;

                if ($department->status == 1) {
                    $td[] = '<span class="text-success fw-bolder">Active</span>';
                } else {
                    $td[] = '<span class="text-danger fw-bolder">Deactive</span>';
                }

                if ($department->userData) {
                    $td[] = $department->userData->name;
                } else {
                    $td[] = '';
                }

                $td[] =  date('Y-m-d', strtotime($department->created_at));
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
