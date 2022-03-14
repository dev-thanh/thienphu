@if($type=='posts')
    @foreach($data as $item)
    <a href="{{route('home.single-news',$item->slug)}}" title="{{$item->name}}" class="project__item ">
        <div class="frame">
            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
        </div>
        <div class="project__box">
            <h2 class="project__title">
                {{$item->name}}
            </h2>
            <div class="time">
                <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="icon__time.svg"> 
                {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
            </div>
        </div>
    </a>
    @endforeach
@else
    @foreach($data as $item)
    <a href="{{route('home.single-project',$item->slug)}}" title="{{$item->name}}" class="project__item ">
        <div class="frame">
            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
        </div>
        <div class="project__box">
            <h2 class="project__title">
                {{$item->name}}
            </h2>
            <div class="time">
                <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="icon__time.svg"> 
                {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
            </div>
        </div>
    </a>
    @endforeach
@endif