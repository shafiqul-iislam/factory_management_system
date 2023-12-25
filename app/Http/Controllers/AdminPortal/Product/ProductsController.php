<?php

namespace App\Http\Controllers\AdminPortal\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $data['departments'] = Department::select('id', 'name')->get();
        return view('theme.admin_portal.products.all', $data);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addLeave = new Product;
            $addLeave->status = ($request->status == 'on') ? 1 : 0;
            $addLeave->department_id = $request->department_id;
            $addLeave->name = $request->name;
            $addLeave->category = $request->category;
            $addLeave->note = $request->note;

            $loginUserData = auth()->user();
            $addLeave->created_by_id = $loginUserData->id;
            $addLeave->created_by_username = $loginUserData->name;
            $response = $addLeave->save();

            if ($response) {
                return redirect('/products')->with('success', 'Successfuly Added');
            } else {
                return redirect('/products')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function edit($id)
    {
        $data['departments'] = Department::select('id', 'name')->get();        
        $data['editProduct'] = Product::findOrFail($id);

        return view('theme.admin_portal.products.edit', $data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->status = ($request->status == 'on') ? 1 : 0;
            $updateProduct->department_id = $request->department_id;
            $updateProduct->name = $request->name;
            $updateProduct->category = $request->category;
            $updateProduct->note = $request->note;          
            $response = $updateProduct->save();

            if ($response) {
                return redirect('/products')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/products')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deleteProduct = Product::findOrFail($id)->delete();
        if ($deleteProduct) {
            return redirect('/products')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/products')->with('error', 'Oops Something Wrong');
        }
    }


    // leave requests dataTables fetch by ajax
    public function serverSideAllProducts(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Product::with(['departmentData', 'userData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $products = $query->get();

        $rows = [];
        if (isset($products)) {
            foreach ($products as $product) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('products/edit', [$product->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('products/delete', [$product->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $product->id;

                if ($product->departmentData) {
                    $td[] = $product->departmentData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $product->name;
                $td[] = $product->category;
                $td[] = $product->note;

                if ($product->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                // created by
                if ($product->userData) {
                    $td[] = $product->userData->name;
                } else {
                    $td[] = '';
                }
                $td[] = date('Y-m-d', strtotime($product->created_at));

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
