<?php

namespace App\Http\Controllers\AdminPortal\Sms;

use App\Jobs\SendSms;
use Illuminate\Http\Request;
use App\Models\SMS\SmsTemplate;
use App\Http\Controllers\Controller;

class SmsTemplateController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.sms.sms_templates');
    }


    public function sendCustomSms()
    {
        $smsData = [
            'phone' => '01317397129',
            'message' => 'Test Message From Laravel',
        ];

        $smsResponse = dispatch(new SendSms($smsData))->delay(now()->addSeconds(30));

        return back()->with('success', 'SMS sent successfully.');
    }


    public function serverSideAllSmsTemplates(Request $request)
    {
        $columns = [
            0 => 'id',
        ];

        $query = SmsTemplate::with(['createdByData'])->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $smsTemplates = $query->get();

        $rows = [];
        if (isset($smsTemplates)) {
            foreach ($smsTemplates as $smsTemplate) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="' . url('sms-templates/edit', [$smsTemplate->id]) . '" class="p-1 me-2">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('sms-templates/delete', [$smsTemplate->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $smsTemplate->id;

                $td[] = $smsTemplate->name;
                $td[] = $smsTemplate->type;
                $td[] = $smsTemplate->template_text;

                if ($smsTemplate->status == 1) {
                    $td[] = 'Active';
                } else {
                    $td[] = 'Deactive';
                }

                // created by
                if ($smsTemplate->createdByData) {
                    $td[] = $smsTemplate->createdByData->name;
                } else {
                    $td[] = '';
                }
                $td[] = date('Y-m-d', strtotime($smsTemplate->created_at));
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
