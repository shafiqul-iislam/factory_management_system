<?php

namespace App\Http\Controllers\AdminPortal\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\HRM\Designation;
use App\Models\HRM\Employee;
use App\Models\Product\Product;
use App\Models\Production\Production;
use Illuminate\Support\Facades\Validator;

class ProductionController extends Controller
{
    public function index()
    {
        $data['products'] = Product::select('id', 'name', 'category')->get();

        return view('theme.admin_portal.production.all', $data);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $productData = Product::findOrFail($request->product_id);

            $addProduction = new Production;
            $addProduction->status = ($request->status == 'on') ? 1 : 0;
            $addProduction->product_id = $productData->id;
            $addProduction->office_shift = $request->office_shift;
            $addProduction->product_category = $productData->category;
            $addProduction->department_id = $productData->department_id;

            $addProduction->production_target = $request->production_target;
            $addProduction->total_production = $request->total_production;
            $addProduction->supervisor_id = $request->supervisor_id;
            $addProduction->note = $request->note;

            $loginUserData = auth()->user();
            $addProduction->created_by_id = $loginUserData->id;
            $addProduction->created_by_username = $loginUserData->name;
            $response = $addProduction->save();

            if ($response) {
                return redirect('/productions')->with('success', 'Successfully Added');
            } else {
                return redirect('/productions')->with('error', 'Oops Something Wrong');
            }
        }
    }

    // productions dataTables fetch by ajax
    public function serverSideAllProductions(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Production::with(['departmentData', 'userData', 'supervisorData', 'productData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $productions = $query->get();

        $rows = [];
        if (isset($productions)) {
            foreach ($productions as $production) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('productions/edit', [$production->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('productions/delete', [$production->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $production->id;

                if ($production->departmentData) {
                    $td[] = $production->departmentData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $production->product_category;

                if ($production->productData) {
                    $td[] = $production->productData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $production->production_target;
                $td[] = $production->total_production;
                $td[] = $production->production_target - $production->total_production;

                if ($production->office_shift == 1) {
                    $td[] = 'Day';
                } else if ($production->office_shift == 2) {
                    $td[] = 'Afternoon';
                } else if ($production->office_shift == 3) {
                    $td[] = 'Night';
                } else if ($production->office_shift == 4) {
                    $td[] = 'Others';
                } else {
                    $td[] = '';
                }

                if ($production->supervisorData) {
                    $td[] = $production->supervisorData->name;
                } else {
                    $td[] = '';
                }

                if ($production->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                // created by
                if ($production->userData) {
                    $td[] = $production->userData->name;
                } else {
                    $td[] = '';
                }
                $td[] = date('Y-m-d', strtotime($production->created_at));
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

    // get supervisor list as per product's department
    public function getEmployees(Request $request)
    {
        $productData = Product::find($request->product_id);

        $designationData = Designation::where('department_id', $productData->department_id)->where('name', 'supervisor')->first();
        
        $employeeData = Employee::where('designation', $designationData->id)->get();

        dd($employeeData);
    }
}
