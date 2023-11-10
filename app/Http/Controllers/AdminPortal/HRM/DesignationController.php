<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use Illuminate\Http\Request;
use App\Models\HRM\Designation;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function index()
    {
        $data['departments'] = Department::select('id', 'name')->get();

        return view('theme.admin_portal.hrm.designations.all', $data);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desination_name' => 'required',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addDesignation = new Designation;
            $addDesignation->name = $request->desination_name;
            $addDesignation->department_id = $request->department_id;
            $addDesignation->note = $request->note;

            $loginUserData = auth()->user();
            $addDesignation->created_by_id = $loginUserData->id;
            $addDesignation->created_by_username = $loginUserData->name;
            $response = $addDesignation->save();

            if ($response) {
                return redirect('/designations')->with('success', 'Successfuly Added');
            } else {
                return redirect('/designations')->with('error', 'Oops Something Wrong');
            }
        }
    }

    public function edit($id)
    {
        $data['editDesignation'] = Designation::findOrFail($id);
        $data['departments'] = Department::select('id', 'name')->get();

        return view('theme.admin_portal.hrm.designations.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desination_name' => 'required',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateDesignation = Designation::findOrFail($request->id);
            $updateDesignation->name = $request->desination_name;
            $updateDesignation->department_id = $request->department_id;
            $updateDesignation->note = $request->note;
            $response = $updateDesignation->save();

            if ($response) {
                return redirect('/designations')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/designations')->with('error', 'Oops Something Wrong');
            }
        }
    }

    public function delete($id)
    {
        $deleteDesignation = Designation::findOrFail($id)->delete();

        if ($deleteDesignation) {
            return redirect('/designations')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/designations')->with('error', 'Oops Something Wrong');
        }
    }

    // designations dataTables fetch by ajax
    public function serverSideAllDesignations(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Designation::with(['departmentData', 'userData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $designations = $query->get();

        $rows = [];
        if (isset($designations)) {
            foreach ($designations as $designation) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('designations/edit', [$designation->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('designations/delete', [$designation->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $designation->id;
                $td[] = $designation->name;
                
                if ($designation->departmentData) {
                    $td[] = $designation->departmentData->name;
                } else {
                    $td[] = '';
                }

                if ($designation->userData) {
                    $td[] = $designation->userData->name;
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
