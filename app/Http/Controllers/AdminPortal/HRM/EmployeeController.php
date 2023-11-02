<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HRM\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.hrm.employees.all');
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
                // created by id
                if ($employee->userData) {
                    $td[] = $employee->userData->name;
                } else {
                    $td[] = '';
                }
                $td[] =  date('Y-m-d', strtotime($employee->created_at));
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
