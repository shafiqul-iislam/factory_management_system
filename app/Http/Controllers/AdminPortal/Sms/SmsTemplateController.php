<?php

namespace App\Http\Controllers\AdminPortal\Sms;

use App\Jobs\SendSms;
use Illuminate\Http\Request;
use App\Models\SMS\SmsTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\Notification\Sms\SmsServices;

class SmsTemplateController extends Controller
{
    public function __construct(
        private SmsServices $smsServices
    ) {}
    public function index()
    {
        return view('theme.admin_portal.sms.sms_templates');
    }


    public function createSmsTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'type' => 'required',
            'template' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $smsTemplate = new SmsTemplate;
            $smsTemplate->status = ($request->status == 'on') ? 1 : 0;
            $smsTemplate->name = $request->name;
            $smsTemplate->type = $request->type;
            $smsTemplate->template_text = $request->template;

            $loginUserData = auth()->user();
            $smsTemplate->created_by_id = $loginUserData->id;
            $smsTemplate->created_by_username = $loginUserData->name;
            $response = $smsTemplate->save();

            if ($response) {
                return redirect()->back()->with('success', 'Successfuly Created Template');
            } else {
                return redirect()->back()->with('error', 'Oops! Something Went Wrong');
            }
        }
    }


    public function sendCustomSms(Request $request)
    {
        $message = 'Test Message From Laravel';

        if (isset($request->template)) {
            $authUser = auth()->user();
            $smsData = [
                'otp' => '1234',
            ];

            $message = $this->smsServices->processSmsTemplate($request->template, $authUser, $smsData);
        }

        $smsDetails = [
            'phone' => $request->phone,
            'message' => $message
        ];

        $smsResponse = dispatch(new SendSms($smsDetails))->delay(now()->addSeconds(30));

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
