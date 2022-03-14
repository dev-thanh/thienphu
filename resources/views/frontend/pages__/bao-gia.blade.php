<?php 
	if(!empty($dataSeo)){
      	$content = json_decode($dataSeo->content);
   	}
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__quote.css" />
@endsection
    <main id="main">

        <section class="page__quote">
            <div class="container">
                <h1 class="title__global">
                    {{@$content->title}}
                </h1>
                <div class="page__quote-content">
                    {!! @$content->desc1 !!}
                </div>
                <div class="box-price clear">
                    <h2>A. ĐIỀN THÔNG TIN</h2>
                    <p class="alert" style="display: none;">Số phòng vệ sinh phải từ 1 - 4<br></p>
                    <form id="form-price">
                        <div class="step step1">
                            <h3><span>1</span> Nhập số liệu</h3>
                            <div class="box-step">
                                <div class="textLabel"> Diện tích căn hộ: </div>
                                <div class="input">
                                    <input type="number" name="area" id="area" placeholder="40 - 300" min="40" max="300"> m2
                                </div>
                            </div>
                            <div class="box-step">
                                <div class="textLabel"> Số phòng ngủ: </div>
                                <div class="input">
                                    <input type="number" name="liveroom" id="liveroom" placeholder="1 - 5" min="1" max="5"> phòng
                                </div>
                            </div>
                            <div class="box-step">
                                <div class="textLabel"> Số lô-gia: </div>
                                <div class="input">
                                    <input type="number" name="logia" id="logia" placeholder="0 - 4" min="0" max="4"> lô gia
                                </div>
                            </div>
                            <div class="box-step">
                                <div class="textLabel"> Số phòng vệ sinh: </div>
                                <div class="input">
                                    <input type="number" name="bathroom" id="bathroom" placeholder="1 - 4" min="1" max="4"> phòng
                                </div>
                            </div>
                        </div>
                        <div class="step step2">
                            <h3><span>2</span> Chọn hạng mục cần thi công</h3>
                            @if(@$content->thongso->op_wc_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="wc">
                                    <span class="text-strong">{{ @$content->thongso->op_wc_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->logia_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="lg">
                                    <span class="text-strong">{{ @$content->thongso->logia_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->tm_wc_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="nwc">
                                    <span class="text-strong">{{ @$content->thongso->tm_wc_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->tc_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="tc">
                                    <span class="text-strong">{{ @$content->thongso->tc_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->den_tc_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="ltc">
                                    <span class="text-strong">{{ @$content->thongso->den_tc_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->htd_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="htc">
                                    <span class="text-strong">{{ @$content->thongso->htd_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->gdt_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="ptc">
                                    <span class="text-strong">{{ @$content->thongso->gdt_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->sgcn_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="stc">
                                    <span class="text-strong">{{ @$content->thongso->sgcn_text }}</span>
                                </label>
                            </div>
                            @endif
                            @if(@$content->thongso->ntdg_stt ==1)
                            <div class="box-step">
                                <label>
                                    <input type="checkbox" value="1" name="ntc" checked="checked">
                                    <span class="text-strong">{{ @$content->thongso->ntdg_text }}</span>
                                </label>
                            </div>
                            @endif
                        </div>
                        <div class="step step3">
                            <h3>
                                <span>3</span> Xem báo giá
                            </h3>
                            <div class="button-end">
                                <button type="button" class="btn btn_price_in">Báo giá</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="result" id="ketqua">
                    <h2>B. KẾT QUẢ</h2>
                    <div class="result-title">
                        <p>
                            Cám ơn các bạn đã quan tâm đến dịch vụ thiết kế và thi công của công ty.
                        </p>
                        <p>
                            -- Chúng tôi xin báo giá tổng quát căn hộ như sau --
                        </p>
                    </div>
                    <div class="step__box">
                        <h3>I/ Phần thiết kế</h3>
                        <ul>
                            <li> • Chi phí thiết kế: <strong id="draw_house">0</strong> .</li>
                            <li> • Thời gian thiết kế: <strong id="draw_time">0</strong> ngày.</li>
                            <li> • Gồm các bản vẽ:</li>
                        </ul>
                        <div class="table__cost">
                            <table id="table">
                                <tr class="table__title gray">
                                    <th>Phòng</th>
                                    <th>Phối cảnh</th>
                                    <th>Mặt bằng</th>
                                    <th>Phần nề</th>
                                    <th>Thạch cao</th>
                                    <th>Điện</th>
                                    <th>Nước</th>
                                    <th>Giấy dán</th>
                                    <th>Nội thất</th>
                                    <th>Tổng cộng</th>
                                </tr>
                            </table>
                            <table id="table_insert">
                                <tr class="">
                                    <td>
                                        Khách, bếp, sảnh, ban công, WC
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr class="">
                                    <td>
                                        Phòng ngủ 1
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr class="">
                                    <td>
                                        Phòng ngủ 2
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr class="">
                                    <td>
                                        Phòng ngủ 3
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr class="">
                                    <td>
                                        Phòng ngủ 4
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr class="">
                                    <td>
                                        Phòng ngủ 5
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr class="table__footer gray">
                                    <th>
                                        TỔNG CỘNG
                                    </th>
                                    <th colspan="9" id="total_html">0</th>
                                </tr>
                            </table>
                        </div>
                        <p>
                            <b>(*) Ghi chú:</b> Dấu "-" thể hiện bản vẽ của mục này sẽ được gộp vào bản vẽ mục phía trên.
                        </p>
                    </div>
                    <div class="step__box step__box-1">
                        <h3>II/ Phần thi công </h3>
                        <ul>
                            <li> • Phần nội thất do MDA.com lắp đặt: <strong id="dowork_house">0</strong> VNĐ.</li>
                            <li> • Phần thiết bị do chủ nhà tự mua: <strong id="yours_house">0</strong> VNĐ. <b>Cụ thể gồm:</b> </li>
                            <li>
                                <ul>
                                    <li>{{@$content->thietbi->gach_text}}: <strong id="gach_house">0</strong> VNĐ.</li>
                                    <li> {{@$content->thietbi->wc_text}}: <strong id="thietbi_house">0</strong> VNĐ.</li>
                                    <li> {{@$content->thietbi->bep_text}}: <strong id="money_bep">0</strong> VNĐ.</li>
                                    <li> {{@$content->thietbi->remcua_text}}: <strong id="rem_house">0</strong> VNĐ.</li>
                                    <li> {{@$content->thietbi->dentt_text}}: <strong id="den_house">0</strong> VNĐ.</li>
                                    <li> {{@$content->thietbi->sofa_text}}: <strong id="sofa_house">0</strong> VNĐ.</li>
                                </ul>
                            </li>
                            <li> • Thời gian thi công: <strong id="dowork_time">0</strong> ngày.</li>
                        </ul>
                        <h3>III/ Tổng kết:</h3>
                        <ul>
                            <li> • Tổng số tiền đầu tư cho ngôi nhà tương lai: <strong id="total_house">0</strong> VNĐ.</li>
                            <li> • Tổng thời gian hoàn thành: <strong id="total_time">0</strong> ngày. </li>
                        </ul>
                        <p>Cảm ơn các bạn đã quan tâm. </p>
                        <p>Trên đây là chi phí thi công và các bước làm việc của MDA.com </p>
                        <p>Hy vọng được tạo nên những ngôi nhà đẹp cho bạn!</p>
                    </div>
                </div>
                <div class="page__quote-content">
                    {!! @$content->desc2 !!}
                </div>
            </div>
        </section>

        <section class="project__related">
            <div class="container">
                <h2 class="related-title">Dự án nổi bật</h2>
                <div class="related-slide">
                    @foreach($projectsHot as $item)
                    <a href="{{route('home.single-project',$item->slug)}}" title="{{$item->name}}" class="project__item">
                        <div class="frame">
                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
                        </div>
                        <div class="time">
                            <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="icon__time.svg" />
                            {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
                        </div>
                        <h2 class="project__title">
                            {{$item->name}}
                        </h2>
                        <div class="project__desc">
                            {!! $item->desc !!}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".related-slide").slick({
                dots: true,
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    },
                }, {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    },
                }, ],
            });

            function formatNumber(number) {
                var number = number.toFixed(2) + '';
                var x = number.split('.');
                var x1 = x[0];
                var x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2')
                }
                return x1
            }

            function isInt(n) {
                return n % 1 === 0
            }

            $('.btn_price_in').click(function() {
                $(".alert").hide();
                var mess = '';
                var area = $("#area").val();
                if (area == '' || (area != '' && isInt(area) && (area < 40 || area > 300))) {
                    mess += 'Diện tích căn hộ phải từ 40 - 300 m2<br />'
                } else if ((area != '' && !isInt(area))) {
                    var exarea = area.split('-')[0].split(' ')[0];
                    if (exarea == '' || (exarea != '' && isInt(exarea) && (exarea < 40 || exarea > 300))) {
                        mess += 'Diện tích căn hộ phải từ 40 - 300 m2<br />'
                    } else {
                        area = exarea
                    }
                }
                var liveroom = $("#liveroom").val();
                if (liveroom == '' || (liveroom != '' && !isInt(liveroom)) || (liveroom != '' && isInt(liveroom) && (liveroom < 1 || liveroom > 5))) {
                    mess += 'Số phòng ngủ phải từ 1 - 5<br />'
                }
                var logia = $("#logia").val();
                if ((logia != '' && !isInt(logia)) || (logia != '' && isInt(logia) && (logia < 0 || logia > 4))) {
                    mess += 'Số lô-gia phải từ 0 - 4<br />'
                } else if (logia == '') {
                    logia = 0
                }
                var bathroom = $("#bathroom").val();
                if (bathroom == '' || (bathroom != '' && !isInt(bathroom)) || (bathroom != '' && isInt(bathroom) && (bathroom < 1 || bathroom > 4))) {
                    mess += 'Số phòng vệ sinh phải từ 1 - 4<br />'
                }
                if (mess == '') {
                    area = parseInt(area);
                    liveroom = parseInt(liveroom);
                    logia = parseInt(logia);
                    bathroom = parseInt(bathroom);
                    if (area / (liveroom + logia + bathroom) < 1) {
                        mess += 'Thông số bạn điền không hợp lý, cần kiểm tra lại!<br />'
                    }
                }
                if (mess != '') {
                    $(".alert").html(mess);
                    $(".alert").show();
                    $('html, body').animate({
                        scrollTop: $(".alert").offset().top - 200
                    }, 500);
                    return !1
                } else {
                    var chiphithietke = 0;
                    $("#draw_house").html('Miễn phí');
                    $("#draw_time").html('{{@$content->time->thietke}}');
                    var total = 0;
                    $("#table_insert tr").each(function(index) {
                        if (index == 0) {
                            $(this).children('td').eq(1).html(12);
                            $(this).children('td').eq(2).html(1);
                            $(this).children('td').eq(3).html(1);
                            $(this).children('td').eq(4).html(4);
                            $(this).children('td').eq(5).html(5);
                            $(this).children('td').eq(6).html(2);
                            $(this).children('td').eq(7).html(1);
                            $(this).children('td').eq(8).html(8);
                            $(this).children('td').eq(9).html(32);
                            total += 32
                        } else if (index > 0 && index < 6) {
                            if (index <= liveroom) {
                                $(this).show();
                                $(this).children('td').eq(1).html(6);
                                $(this).children('td').eq(4).html(1);
                                $(this).children('td').eq(6).html(0);
                                $(this).children('td').eq(8).html(7);
                                $(this).children('td').eq(9).html(14);
                                total += 14
                            } else {
                                $(this).hide()
                            }
                        } else {
                            $('#total_html').html(total)
                        }
                    });
                    var tongchiphi = 0;
                    if ($("input[name=wc]").is(":checked")) {
                        tongchiphi += bathroom * {{@$content->thongso->op_wc ? @$content->thongso->op_wc : 0}}
                    }
                    if ($("input[name=lg]").is(":checked")) {
                        tongchiphi += logia * {{@$content->thongso->logia ? @$content->thongso->logia : 0}}
                    }
                    if ($("input[name=nwc]").is(":checked")) {
                        tongchiphi += bathroom * {{@$content->thongso->tm_wc ? @$content->thongso->tm_wc : 0}}
                    }
                    if ($("input[name=tc]").is(":checked")) {
                        tongchiphi += area * {{@$content->thongso->tc ? @$content->thongso->tc : 0}}
                    }
                    if ($("input[name=ltc]").is(":checked")) {
                        tongchiphi += area * {{@$content->thongso->den_tc ? @$content->thongso->den_tc : 0}}
                    }
                    if ($("input[name=htc]").is(":checked")) {
                        tongchiphi += area * {{@$content->thongso->htd ? @$content->thongso->htd : 0}}
                    }
                    if ($("input[name=ptc]").is(":checked")) {
                        tongchiphi += area * {{@$content->thongso->gdt ? @$content->thongso->gdt : 0}}
                    }
                    if ($("input[name=stc]").is(":checked")) {
                        tongchiphi += area * {{@$content->thongso->sgcn ? @$content->thongso->sgcn : 0}}
                    }
                    if ($("input[name=ntc]").is(":checked")) {
                        tongchiphi += area * {{@$content->thongso->ntdg ? @$content->thongso->ntdg : 0}}
                    }
                    $("#dowork_house").html(formatNumber(tongchiphi));
                    var tongchunhamua = 0;
                    var gachoplat = 0;
                    if ($("input[name=wc]").is(":checked")) {
                        gachoplat += bathroom * {{@$content->thietbi->gach1}}
                    }
                    if ($("input[name=lg]").is(":checked")) {
                        gachoplat += logia * {{@$content->thietbi->gach2}}
                    }
                    tongchunhamua += gachoplat;
                    $("#gach_house").html(formatNumber(gachoplat));
                    tongchunhamua += $("input[name=nwc]").is(":checked") ? bathroom * {{@$content->thietbi->wc}} : 0;
                    $("#thietbi_house").html($("input[name=nwc]").is(":checked") ? formatNumber(bathroom * {{@$content->thietbi->wc}}) : 0);
                    tongchunhamua += {{@$content->thietbi->bep}};
                    $("#money_bep").html(formatNumber({{@$content->thietbi->bep}}));
                    tongchunhamua += (liveroom + 1) * {{@$content->thietbi->remcua}};
                    $("#rem_house").html(formatNumber((liveroom + 1) * {{@$content->thietbi->remcua}}));
                    tongchunhamua += (liveroom + 1) * {{@$content->thietbi->dentt1}} + {{@$content->thietbi->dentt2}};
                    $("#den_house").html(formatNumber((liveroom + 1) * {{@$content->thietbi->dentt1}} + {{@$content->thietbi->dentt2}}));
                    tongchunhamua += {{@$content->thietbi->sofa}};
                    $("#sofa_house").html(formatNumber({{@$content->thietbi->sofa}}));
                    $("#dowork_time").html('{{@$content->time->thicong}}');
                    $("#yours_house").html(formatNumber(tongchunhamua));
                    $("#total_house").html(formatNumber(chiphithietke + tongchiphi + tongchunhamua));
                    $("#total_time").html('{{@$content->time->hoanthanh}}');
                    $('html, body').animate({
                        scrollTop: $("#ketqua").offset().top - 100
                    }, 500)
                }
            });
        });
    </script>
@endsection