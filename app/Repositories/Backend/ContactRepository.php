<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\ContactRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Pusher\Pusher;
use DB;
use App\Notifications\ContactNotification;
use App\Trails\MailTrait;
use App\Models\Contact;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    use MailTrait;

    public function model()
    {
        return Contact::class;
    } 

    public function saveContact($request)
    {
        $message = 'Gửi liên hệ thành công, chúng tôi sẽ liện hệ với bạn trong thời gian sớm nhất, xin cảm ơn!';
    	
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->content = $request->content;
            $contact->status = 0;
            $contact->save();

            $email_admin = getOptions('general', 'email_admin');

            $content_email = [
                'title' => $request->title,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->content,
                'url' => route('contact.edit', $contact->id),
            ];

            $data = [
            	'title' => 'Liên hệ từ khách hàng',
            	'name' => $request->name,
            	'contact_id' => $contact->id,
            	'url' => route('contact.edit', $contact->id),
            ];

            $contact->notify(new ContactNotification($data));

            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), array('cluster' =>  env('PUSHER_APP_CLUSTER')));

            $pusher->trigger('contact-pusher', 'new-contact', $data);

            $this->initMailConfig();

            Mail::send('frontend.mail.mail-contact', $content_email , function ($msg) use ($email_admin) {
        
                $msg->from(config('mail.username'), 'CÔNG TY TNHH THƯƠNG MẠI VÀ CHẾ TẠO MÁY THIÊN PHÚ');

                $msg->to($email_admin)->subject('CÔNG TY TNHH THƯƠNG MẠI VÀ CHẾ TẠO MÁY THIÊN PHÚ');

            });
            
        } catch (\Throwable $th) {
          
        }

        return response()->json([
            'success'=>true,
            'message'=> $message
        ]);
    }
}
