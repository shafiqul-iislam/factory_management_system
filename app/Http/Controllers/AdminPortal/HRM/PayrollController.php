<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use App\Models\HRM\Payroll;
use App\Models\HRM\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        return view('theme.admin_portal.hrm.payroll.all', $data);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'amount' => 'required',
            'method' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addPayroll = new Payroll;
            $addPayroll->status = ($request->status == 'on') ? 1 : 0;
            $addPayroll->employee_id = $request->employee_id;
            $addPayroll->date = $request->date;
            $addPayroll->amount = $request->amount;
            $addPayroll->method = $request->method;
            $addPayroll->note = $request->note;

            $loginUserData = auth()->user();
            $addPayroll->created_by_id = $loginUserData->id;
            $addPayroll->created_by_username = $loginUserData->name;
            $response = $addPayroll->save();

            if ($response) {
                return redirect('/payrolls')->with('success', 'Successfuly Added');
            } else {
                return redirect('/payrolls')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function edit($id)
    {
        $data['employees'] = Employee::select('id', 'name')->get();
        $data['editPayroll'] = Payroll::findOrFail($id);

        return view('theme.admin_portal.hrm.payroll.edit', $data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'amount' => 'required',
            'method' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updatePayroll = Payroll::findOrFail($request->id);
            $updatePayroll->status = ($request->status == 'on') ? 1 : 0;
            $updatePayroll->employee_id = $request->employee_id;
            $updatePayroll->date = $request->date;
            $updatePayroll->amount = $request->amount;
            $updatePayroll->method = $request->method;
            $updatePayroll->note = $request->note;

            $response = $updatePayroll->save();

            if ($response) {
                return redirect('/payrolls')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/payrolls')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deletePayroll = Payroll::findOrFail($id)->delete();
        if ($deletePayroll) {
            return redirect('/payrolls')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/payrolls')->with('error', 'Oops Something Wrong');
        }
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
                if (($payroll->employeeData->departmentData)) {
                    $td[] = $payroll->employeeData->departmentData->name;
                } else {
                    $td[] = '';
                }

                if (isset($payroll->employeeData)) {
                    $td[] = $payroll->employeeData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $payroll->amount;
                if ($payroll->method == 1) {
                    $td[] = 'Cash';
                } else if ($payroll->method == 2) {
                    $td[] = 'Cheque';
                } else {
                    $td[] = 'Others';
                }

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
