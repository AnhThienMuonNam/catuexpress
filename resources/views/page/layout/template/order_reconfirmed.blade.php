<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thông tin Đơn hàng</title>
</head>

<body>
    <div style="width:722px; border:solid 1px #CCC; font-family:Arial, Helvetica, sans-serif; padding:10px; margin:10px auto; line-height:130%; font-size:14px; color: #333;">

        <div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
                <tr>
                    <td style="font-style:italic; font-size: 15px; color: red;">Lưu ý: Đây là email tự động, xin vui lòng không trả lời email này.</td>
                </tr>
            </table>
        </div>
        <div style="background-repeat:no-repeat; padding-top:20px;">
            <p>Xin chào <span style=" color:#0d7caa; font-weight:bold;">{{$contentEmail['order']->customer_name}}</span></p>
            CatuExpress gửi bạn thông tin chi tiết đơn hàng bao gồm phần nội dung chi tiết:


            <div style="border-bottom: dashed 1px #CCC;line-height:20px; padding-bottom:10px; padding-top: 10px"><span style=" color:#0d7caa; font-weight:bold;text-decoration:underline;"> Thông Tin Người Đặt:</span> <br />
                <table width="100%">

                    <tr>
                        <td>
                            Họ tên
                        </td>
                        <td>
                            {{$contentEmail['order']->customer_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Số điện thoại
                        </td>
                        <td>
                            {{$contentEmail['order']->customer_phone}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            {{$contentEmail['order']->customer_email}}
                        </td>
                    </tr>

                </table>
            </div>
            <div style="border-bottom: dashed 1px #CCC;line-height:20px; padding-bottom:10px; padding-top: 10px"><span style=" color:#0d7caa; font-weight:bold;text-decoration:underline;"> Thông Tin Chuyến:</span> <br />
                <table width="100%">
                    <tr>
                        <td>Tour</td>
                        <td>
                            {{$contentEmail['order']->tour->title}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Số hành khách
                        </td>
                        <td>
                            {{$contentEmail['order']->no_of_passengers}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Loại xe
                        </td>
                        <td>
                            {{$contentEmail['order']->car_type}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nơi đón
                        </td>
                        <td>
                            {{$contentEmail['order']->pick_up_location}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Thời gian đón
                        </td>
                        <td>
                            {{$contentEmail['order']->pick_up_time}}
                        </td>
                    </tr>
                </table>
            </div>

            <div style="border-bottom: dashed 1px #CCC;line-height:20px; padding-bottom:10px; padding-top: 10px"><span style=" color:#0d7caa; font-weight:bold;text-decoration:underline;">Nội Dung Chi Tiết:</span> <br />
                <div style="margin-bottom:20px;"> {{$contentEmail['order']->detail}}</div>
                <div style="margin-bottom:15px;"><u>Tài xế</u> : {{$contentEmail['order']->driver->name}} (SĐT: {{$contentEmail['order']->driver->phone}})</div>
                <div style="margin-bottom:20px;"><u>Loại xe</u> : {{$contentEmail['order']->car_model}} </div>
                <div style="margin-bottom:20px;"><u>Giá</u> : {{number_format($contentEmail['order']->price)}} VNĐ </div>
                <div style="color: red;">
                    *Mọi thắc mắc xin vui lòng liên hệ theo SĐT hoặc Email bên dưới. Trân trọng!
                </div>
                <div style="  border-bottom: dashed 1px #CCC; padding-bottom:10px;"></div>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="49%" align="right" style="padding-right:10px; color:#0d7caa;  line-height:23px;">
                            SĐT :<br /> Email :<br /> Website :
                        </td>
                        <td width="51%" align="left" style="color:#0d7caa; line-height:23px; font-weight:bold;">
                            {{$contentEmail['about_us']->phone}}<br /> {{$contentEmail['about_us']->email}}<br /> <a href="https://catuexpress.com">CatuExpress</a>
                        </td>

                    </tr>
                </table>

                <div style="  border-bottom: dashed 1px #CCC; padding-bottom:10px;"></div>
            </div>

        </div>
</body>

</html>