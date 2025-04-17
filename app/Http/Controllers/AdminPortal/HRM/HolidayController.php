<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use App\Models\HRM\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.hrm.holidays.all');
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addHoliday = new Holiday;
            $addHoliday->status = ($request->status == 'on') ? 1 : 0;
            $addHoliday->title = $request->title;
            $addHoliday->start_date = $request->start_date;
            $addHoliday->finish_date = $request->finish_date;
            $addHoliday->note = $request->note;

            $loginUserData = auth()->user();
            $addHoliday->created_by_id = $loginUserData->id;
            $addHoliday->created_by_username = $loginUserData->name;
            $response = $addHoliday->save();

            if ($response) {
                return redirect('/holidays')->with('success', 'Successfuly Added');
            } else {
                return redirect('/holidays')->with('error', 'Oops Something Wrong');
            }
        }
    }

    public function edit($id)
    {
        $data['editHoliday'] = Holiday::findOrFail($id);
        return view('theme.admin_portal.hrm.holidays.edit', $data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {
            $updateHoliday = Holiday::findOrFail($request->id);
            $updateHoliday->status = ($request->status == 'on') ? 1 : 0;
            $updateHoliday->title = $request->title;
            $updateHoliday->start_date = $request->start_date;
            $updateHoliday->finish_date = $request->finish_date;
            $updateHoliday->note = $request->note;
            $response = $updateHoliday->save();

            if ($response) {
                return redirect('/holidays')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/holidays')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deleteHoliday = Holiday::findOrFail($id)->delete();
        if ($deleteHoliday) {
            return redirect('/holidays')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/holidays')->with('error', 'Oops Something Wrong');
        }
    }


    // holidays dataTables fetch by ajax
    public function serverSideAllHolidays(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Holiday::with(['userData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $holidays = $query->get();

        $rows = [];
        if (isset($holidays)) {
            foreach ($holidays as $holiday) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('holidays/edit', [$holiday->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('holidays/delete', [$holiday->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $holiday->id;
                $td[] = $holiday->title;
                $td[] = $holiday->start_date;
                $td[] = $holiday->finish_date;
                // $td[] = strtotime($holiday->start_date) - strtotime($holiday->finish_date);
                $td[] = '';

                if ($holiday->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                $td[] = date('Y-m-d', strtotime($holiday->created_at));
                // created by
                if ($holiday->userData) {
                    $td[] = $holiday->userData->name;
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
