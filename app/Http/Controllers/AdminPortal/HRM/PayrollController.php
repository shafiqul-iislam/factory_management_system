<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use App\Models\HRM\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HRM\Payroll;

class PayrollController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        return view('theme.admin_portal.hrm.payroll.all', $data);
    }


    // payroll dataTables fetch by ajax
    public function serverSideAllPayrolls(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Payroll::with(['employeeData', 'userData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $payrolls = $query->get();

        $rows = [];
        if (isset($payrolls)) {
            foreach ($payrolls as $payroll) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('payrolls/edit', [$payroll->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('payrolls/delete', [$payroll->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $payroll->id;

                if ($payroll->employeeData) {
                    $td[] = $payroll->employeeData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $payroll->amount;
                $td[] = $payroll->method;
                $td[] = $payroll->date;

                if ($payroll->status == 1) {
                    $td[] = 'Paid';
                } else {
                    $td[] = 'Unpaid';
                }

                // created by
                if ($payroll->userData) {
                    $td[] = $payroll->userData->name;
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
