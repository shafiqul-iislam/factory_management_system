<?php

namespace App\Http\Controllers\AdminPortal\Inventory;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.inventory.customer.all');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addCustomer = new Customer;
            $addCustomer->status = ($request->status == 'on') ? 1 : 0;
            $addCustomer->name = $request->name;
            $addCustomer->phone = $request->phone;
            $addCustomer->email = $request->email;
            $addCustomer->password = Hash::make($request->password);
            $addCustomer->address = $request->address;
            $addCustomer->note = $request->note;

            $loginUserData = auth()->user();
            $addCustomer->created_by_id = $loginUserData->id;
            $addCustomer->created_by_username = $loginUserData->name;
            $response = $addCustomer->save();

            if ($response) {
                return redirect('/customers')->with('success', 'Successfully Added');
            } else {
                return redirect('/customers')->with('error', 'Oops! Something Wrong');
            }
        }
    }

    public function edit($id)
    {
        $data['editCustomer'] = Customer::findOrFail($id);
        return view('theme.admin_portal.inventory.customer.edit', $data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateCustomer = Customer::findOrFail($request->id);
            $updateCustomer->status = ($request->status == 'on') ? 1 : 0;
            $updateCustomer->name = $request->name;
            $updateCustomer->phone = $request->phone;
            $updateCustomer->email = $request->email;
            $updateCustomer->address = $request->address;
            $updateCustomer->note = $request->note;
            $response = $updateCustomer->save();

            if ($response) {
                return redirect('/customers')->with('success', 'Successfully Updated');
            } else {
                return redirect('/customers')->with('error', 'Oops! Something Wrong');
            }
        }
    }


    // leave requests dataTables fetch by ajax
    public function serverSideAllCustomers(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Customer::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $cutomers = $query->get();

        $rows = [];
        if (isset($cutomers)) {
            foreach ($cutomers as $cutomer) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                     <a href="' . url('customers/edit', [$cutomer->id]) . '" class="p-1 me-2">
                         <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                     </a>
 
                     <a href="#" class="p-1">
                     <form action="' .  url('customers/delete', [$cutomer->id]) . '" method="POST">
                     ' . method_field("DELETE") . '
                     ' . csrf_field() . '
                         <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                     </form>
                     </a> </div>';

                $td = [];
                $td[] = $cutomer->id;
                $td[] = $cutomer->name;
                $td[] = $cutomer->email;
                $td[] = $cutomer->phone;
                $td[] = $cutomer->address;

                if ($cutomer->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                // created by
                if ($cutomer->userData) {
                    $td[] = $cutomer->userData->name;
                } else {
                    $td[] = '';
                }
                $td[] = date('Y-m-d', strtotime($cutomer->created_at));
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
