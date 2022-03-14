<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\VideosRepository;

class VideosController extends Controller
{
    protected $videos;

	protected function fields()
    {
        return [
            'name' => "required",
            'desc' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống.', 
            'desc.required' => 'Url video không được bỏ trống.',
        ];
    }

    protected function module(){
        return [
            'name' => 'Danh sách videos',
            'module' => 'videos',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'slug' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
            ]
        ];
    }

	public function __construct(VideosRepository $videos)
	{
		$this->videos = $videos;
	}

    public function index()
    {
        $data['module'] = $this->module();

        $data['data'] = $this->videos->orderBy('created_at','DESC')->get();

        return view("backend.videos.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getYoutubeEmbedUrl($url)
    {
         $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
         $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
    
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
    
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        return $youtube_id;
    }
    
    public function create()
    {
        $data['module'] = $this->module();

        return view("backend.videos.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, $this->fields(), $this->messages());

        $input = $request->all();

        $videoId = $request->videoId;

        $thumbURL = 'http://img.youtube.com/vi/'.$videoId.'/0.jpg';

        $iframe = '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/'.$videoId.'"></iframe>';

        $input['image'] = $thumbURL;

        $input['desc'] = $iframe;

        $data = $this->videos->create($input);

        return redirect()->route("videos.index")->with('success', 'Thêm mới video thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);

        $data['data'] = $this->videos->find($id);

        return view("backend.videos.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->fields(), $this->messages());

        $input = $request->all();

        $videoId = $request->videoId;

        $thumbURL = 'http://img.youtube.com/vi/'.$videoId.'/0.jpg';

        $iframe = '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/'.$videoId.'"></iframe>';

        $input['image'] = $thumbURL;

        $input['desc'] = $iframe;

        $this->videos->updateById($id, $input);

        return back()->with('success', 'Cập nhập video thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->videos->deleteById($id);

        return redirect()->route('videos.index')->with('success', 'Xóa video thành công');
    }
}
