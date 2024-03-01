<?php

namespace App\Http\Controllers\AdminPortal\Inventory;

use Illuminate\Http\Request;
use App\Models\Warehouse\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.inventory.warehouse.all');
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addWarehouse = new Warehouse;
            $addWarehouse->status = ($request->status == 'on') ? 1 : 0;
            $addWarehouse->name = $request->name;
            $addWarehouse->address = $request->address;
            $addWarehouse->note = $request->note;

            $loginUserData = auth()->user();
            $addWarehouse->created_by_id = $loginUserData->id;
            $addWarehouse->created_by_username = $loginUserData->name;
            $response = $addWarehouse->save();

            if ($response) {
                return redirect('/warehouses')->with('success', 'Successfully Added');
            } else {
                return redirect('/warehouses')->with('error', 'Oops! Something Wrong');
            }
        }
    }

    public function edit($id)
    {
        $data['editWarehouse'] = Warehouse::findOrFail($id);
        return view('theme.admin_portal.inventory.warehouse.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateWarehouse = Warehouse::findOrFail($request->id);
            $updateWarehouse->status = ($request->status == 'on') ? 1 : 0;
            $updateWarehouse->name = $request->name;
            $updateWarehouse->address = $request->address;
            $updateWarehouse->note = $request->note;
            $response = $updateWarehouse->save();

            if ($response) {
                return redirect('/warehouses')->with('success', 'Successfully Updated');
            } else {
                return redirect('/warehouses')->with('error', 'Oops! Something Wrong');
            }
        }
    }

    public function delete($id)
    {
        $deleteProduct = Warehouse::findOrFail($id)->delete();
        if ($deleteProduct) {
            return redirect('/warehouses')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/warehouses')->with('error', 'Oops Something Wrong');
        }
    }

    // warehouse dataTables fetch by ajax
    public function serverSideAllWarehouses(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Warehouse::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $warehouses = $query->get();

        $rows = [];
        if (isset($warehouses)) {
            foreach ($warehouses as $warehouse) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                     <a href="' . url('warehouses/edit', [$warehouse->id]) . '" class="p-1 me-2">
                         <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                     </a>
 
                     <a href="#" class="p-1">
                     <form action="' .  url('warehouses/delete', [$warehouse->id]) . '" method="POST">
                     ' . method_field("DELETE") . '
                     ' . csrf_field() . '
                         <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                     </form>
                     </a> </div>';

                $td = [];
                $td[] = $warehouse->id;
                $td[] = $warehouse->name;
                $td[] = $warehouse->address;
                $td[] = $warehouse->note;

                if ($warehouse->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                // created by
                if ($warehouse->userData) {
                    $td[] = $warehouse->userData->name;
                } else {
                    $td[] = '';
                }
                $td[] = date('Y-m-d', strtotime($warehouse->created_at));

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
