<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\OptionsRepository;
use App\Mail\SendTestEmail;
use Mail;
use App\Trails\MailTrait;


class SettingController extends Controller
{
    use MailTrait;
    
	protected $options;

	public function __construct(OptionsRepository $options)
	{
		$this->options = $options;
	}

    public function getDeveloperConfig()
    {
        $content = $this->options->where('type', 'dev-config')->first();

    	$content = json_decode(@$content->content);

    	return view('backend.options.developer-config', compact('content'));
    }

    public function postDeveloperConfig(Request $request)
    {
    	$options = $this->options->where('type', 'dev-config')->first();

		$options->content = !empty($request->content) ? json_encode($request->content) : null;

    	$options->save();

    	return back()->with('success', 'Cập nhập thành công');

    }

    public function cssJsConfig()
    {
        $content = $this->options->where('type', 'css-js-config')->first();

        $content = json_decode(@$content->content);

        return view('backend.options.css-js-config', compact('content'));
    }

    public function postCssJsConfig(Request $request)
    {
        $options = $this->options->where('type', 'css-js-config')->first();

        $options->content = !empty($request->content) ? json_encode($request->content) : null;

        $options->save();

        return back()->with('success', 'Cập nhập thành công');
    }

    public function getGeneralConfig()
    {
        $content = $this->options->where('type', 'general')->first();

        //dd($content);
        $content = json_decode(@$content->content);
        return view('backend.options.general', compact('content'));
    }

    public function postGeneralConfig(Request $request)
    {
        $options = $this->options->where('type', 'general')->first();
        $options->content = !empty($request->content) ? json_encode($request->content) : null;
        $options->save();
        return back()->with('success', 'Cập nhập thành công');
    }

    public function getSmtpConfig()
    {
        $data = $this->options->where('type', 'smtp-config')->first();
        $content = json_decode($data->content);
        return view('backend.options.smtp-config', compact('content'));   
    }

    public function postSmtpConfig(Request $request)
    {
        $content = $this->options->where('type', 'smtp-config')->first();
        $content->content = !empty($request->content) ? json_encode($request->content) : null;
        $content->save();
        return back()->with('success', 'Cập nhập thành công');
    }

    public function postSendTestEmail(Request $request)
    {
        $this->initMailConfig();
        $contact['email'] = $request->smtp_email;
        $contact['title'] = $request->smtp_title;
        $contact['smtp_message'] = $request->smtp_message;
        Mail::to($contact['email'])->send(new SendTestEmail($contact));
        return back()->with('success', 'Gửi thành công');
    }
}
