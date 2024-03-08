<?php

namespace App\Http\Controllers\AdminPortal\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stock\StockAdjustment;

class StockAdjustmentController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.inventory.stock_adjustment.all');
    }


    // stocks dataTables fetch by ajax
    public function serverSideAllStocks(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = StockAdjustment::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $stocks = $query->get();

        $rows = [];
        if (isset($stocks)) {
            foreach ($stocks as $stock) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                     <a href="' . url('stocks/edit', [$stock->id]) . '" class="p-1 me-2">
                         <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                     </a>
 
                     <a href="#" class="p-1">
                     <form action="' .  url('stocks/delete', [$stock->id]) . '" method="POST">
                     ' . method_field("DELETE") . '
                     ' . csrf_field() . '
                         <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                     </form>
                     </a> </div>';

                $td = [];
                $td[] = $stock->id;
                $td[] = '';
                $td[] = $stock->stock_quantity;
                $td[] = $stock->note;

                if ($stock->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                $td[] = date('Y-m-d', strtotime($stock->created_at));

                // created by
                if ($stock->userData) {
                    $td[] = $stock->userData->name;
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
