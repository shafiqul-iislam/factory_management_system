<?php

namespace App\Http\Controllers\AdminPortal\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Production\Production;

class ProductionController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.production.all');
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

                $td[] = $production->category;

                if ($production->productData) {
                    $td[] = $production->productData->name;
                } else {
                    $td[] = '';
                }

                $td[] = '';
                $td[] = '';
                $td[] = '';
                $td[] = '';

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
}
