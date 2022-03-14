<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Pages;
use App\Models\Phongthuy;
use App\Repositories\Backend\PagesRepository;
use App\Repositories\Backend\OptionsRepository;

class HomeController extends Controller
{
	protected $pages,$options;

	public function __construct(PagesRepository $pages, OptionsRepository $options)
	{
		$this->pages = $pages;
        $this->options = $options;
	}

    public function index()
    {
        $dataPages = $this->pages->get();
        
        return view('backend.home', compact('dataPages'));
    }


    public function getLayOut(Request $request)
    {
    	$index = $request->index;
    	$type = $request->type;
    	if(view()->exists('backend.repeater.row-'.$type)){
		    return view('backend.repeater.row-'.$type, compact('index'))->render();
		}
		return '404';
    }

    public function saveColorSetting(Request $request)
    {
        $option = $this->options->where('type','color_setting')->first();

        $content = json_encode($request->all());

        $option->update(['content'=>$content]);

        return response()->json([
            'success' => true
        ]);

    }

    public function getNotifications()
    {
        $data = DB::table('notifications')->orderBy('created_at','DESC')->paginate(4);

        $countNotification = DB::table('notifications')->where('read_at',null)->get();

        return view('backend.notifications.ajax-notification',compact('data','countNotification'))->render();
    }

    // public function curlPost($year,$gender)
    // {
    //     $url = "https://moivaonhatoi.com/wp-admin/admin-ajax.php";

    //     $curl = curl_init($url);
    //     curl_setopt($curl, CURLOPT_URL, $url);
    //     curl_setopt($curl, CURLOPT_POST, true);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //     $headers = array(
    //     "Content-Type: application/x-www-form-urlencoded",
    //     );
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    //     $data = "action=get_menhquai&year=".$year."&gender=".$gender;

    //     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //     //for debug only!
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    //     $resp = curl_exec($curl);
    //     curl_close($curl);

    //     $data = new Phongthuy();
    //     $data->namsinh = $year;
    //     $data->gioitinh = $gender;
    //     $data->content = $resp;
    //     $data->save();


    //     return true;
    // }
    public function getPhongthuy()
    {
        // for ($i=1948; $i < 2021; $i++) { 
        //     $nam = $this->curlPost($i,1);
        //     $nu = $this->curlPost($i,2);
        // }
        return 'ok';
    }
}
