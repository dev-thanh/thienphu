<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	<i class="fa fa-bell"></i>
	<span class="notification count-notification">{{count($countNotification)}}</span>
</a>
<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
	<li>
		<div class="dropdown-title dropdown-title-count">Bạn có {{count($countNotification)}} thông báo chưa xem</div>
	</li>
	<li>
		<div class="notif-scroll scrollbar-outer">
			<div class="notif-center list-notifications">
				@foreach($data as $item)
				<?php $data = json_decode($item->data); ?>
				<a href="{{@$data->contact_id ? route('contact.edit', @$data->contact_id) : ''}}">
					<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
					<div class="notif-content">
						<span class="block">
							{{@$data->title}} <b>{{@$data->name}}</b>
						</span>
						<span class="time">{{\Carbon\Carbon::parse(@$item->created_at)->diffForHumans()}}</span> 
					</div>
				</a>
				@endforeach
			</div>
		</div>
	</li>
	<li>
		<a class="see-all" href="javascript:void(0);">Xem tất cả<i class="fa fa-angle-right"></i> </a>
	</li>
</ul>