<?php

namespace App\Http\Controllers\Setup\EmailTemplate;

use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Setup\CoreSettings\Coresettings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;

class EmailTemplateController extends Controller
{

    public function booking_cancel()
    {
        if(Auth::check()) {
            $booking         = CoreSettings::select('code','description')->where('code','BOOKING_CANCEL')->first();
            return view('backend.email_template.booking_cancel')
                ->with('booking',$booking);
        }
        return redirect('/backend_app/login');
    }

    public function booking_confirm()
    {
        if(Auth::check()) {
            $booking         = CoreSettings::select('code','description')->where('code','BOOKING_CONFIRM')->first();
            return view('backend.email_template.booking_confirm')
                ->with('booking',$booking);
        }
        return redirect('/backend_app/login');
    }

    public function booking_edit()
    {
        if(Auth::check()) {
            $booking         = CoreSettings::select('code','description')->where('code','BOOKING_EDIT')->first();
            return view('backend.email_template.booking_edit')
                ->with('booking',$booking);
        }
        return redirect('/backend_app/login');
    }

    public function update(Request $request)
    {
        $code                     = Input::get('id');
        $description              = Input::get('description');

        //Check empty html tag
        $check_empty_desc         = strip_tags($description);
        $check_empty_desc         = strlen($check_empty_desc);
        if ($check_empty_desc <= 0) {
            $description          = '';
        }

        DB::table('core_settings')->where('code', $code)->update(['description' => $description]);

        if ($code == 'BOOKING_CANCEL')
        {
            return redirect('backend_app/email_template_booking_cancel')->with(FormatGenerator::message('Success', 'Template updated ...'));
        }

        if ($code == 'BOOKING_CONFIRM')
        {
            return redirect('backend_app/email_template_booking_confirm')->with(FormatGenerator::message('Success', 'Template updated ...'));
        }

        if ($code == 'BOOKING_EDIT')
        {
            return redirect('backend_app/email_template_booking_edit')->with(FormatGenerator::message('Success', 'Template updated ...'));
        }

    }
}
