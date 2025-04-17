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

            $addProduct = new Product;
            $addProduct->status = ($request->status == 'on') ? 1 : 0;
            $addProduct->product_code = $request->product_code;
            $addProduct->department_id = $request->department_id;
            $addProduct->name = $request->name;
            $addProduct->category = $request->category;
            $addProduct->brand = $request->brand;
            $addProduct->units = $request->units;
            $addProduct->alert_quantity = $request->alert_quantity;
            $addProduct->note = $request->note;

            $loginUserData = auth()->user();
            $addProduct->created_by_id = $loginUserData->id;
            $addProduct->created_by_username = $loginUserData->name;
            $response = $addProduct->save();

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
            $updateProduct->product_code = $request->product_code;
            $updateProduct->department_id = $request->department_id;
            $updateProduct->name = $request->name;
            $updateProduct->category = $request->category;
            $updateProduct->brand = $request->brand;
            $updateProduct->units = $request->units;
            $updateProduct->alert_quantity = $request->alert_quantity;
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
                $td[] = $product->product_code;
                $td[] = $product->name;

                if ($product->departmentData) {
                    $td[] = $product->departmentData->name;
                } else {
                    $td[] = '';
                }

                $td[] = $product->category;
                $td[] = $product->units;
                $td[] = $product->brand;
                $td[] = $product->alert_quantity;

                if ($product->status == 1) {
                    $td[] = '<span class="text-success">Active</span>';
                } else {
                    $td[] = '<span class="text-danger">Deactive</span>';
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
