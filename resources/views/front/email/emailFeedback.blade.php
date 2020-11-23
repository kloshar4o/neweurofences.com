<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Letter</title>
</head>
<body>

<table style="width: 600px; height: auto; max-height: 100000000000px; border-spacing: 0; border-collapse: collapse; font-family: Arial,sans-serif; background-color: #bcebee; text-align: center; margin: 0 auto; padding: 0;"
       bgcolor="#bcebee">
    <tbody>
    <tr>
        <td style="width: 100%; padding: 20px 20px 0;">

            <table style="width: 100%; height: auto; max-height: 100000000000px; border-spacing: 0; border-collapse: collapse; font-family: Arial,sans-serif; margin: 0 auto;">
                <tbody>

                <tr style="height: auto; background-color: #26cad3; padding: 55px 0;" bgcolor="#26cad3">
                    <td style="width: 100%; padding: 55px 5px;">
                        <img src="{{asset('front-assets/img/email/letter.png')}}" alt="letter"
                             style="padding-bottom: 40px; margin: 0 auto;"><br>
                        <span style="width: 100%; color: #fff; font-size: 24px;">
                            {{myTrans('Feedback from')}}
                            <a style="color:#fff" href="{{url('')}}">{{request()->getHost()}}</a>
                        </span>
                    </td>
                </tr>

                <tr style="background-color: #fff; height: auto; max-height: 100000000000px;" bgcolor="#fff">
                    <td style="width: 100%; padding: 40px 20px;">
                        <a href="{{url('')}}" style="text-decoration: none;">

                            <span style="font-size: 38px;
                                         display: block;
                                         text-align: center;
                                         color: #7c5f56;
                                         letter-spacing: 2px;">GMD</span>

                            <span style="display: block;
                                         text-align: center;
                                         font-size: 12px;
                                         color: grey;
                                         letter-spacing: 1px;">GarduriMD.ro</span>
                        </a>

                    </td>
                </tr>

                <tr style="background-color: #fff; height: auto; max-height: 100000000000px;" bgcolor="#fff">
                    <td style="width: 100%; padding-bottom: 40px;">
                        <table style="width: 90%; border-spacing: 0; border-collapse: collapse; margin: 0 auto;">
                            <tbody>
                            <tr>
                                <td style="width: 50%; background-color: #fff; padding: 20px 10px; border: 1px solid #d3d3d3;"
                                    bgcolor="#fff"><span
                                            style="font-size: 18px; color: #80a2a6;">{{ trans('variables.name_text')  }}</span>
                                </td>
                                <td style="width: 50%; background-color: #fff; padding: 20px 10px; border: 1px solid #d3d3d3;"
                                    bgcolor="#fff"><span
                                            style="font-size: 18px; color: #80a2a6;">{{$data['name'] or ''}}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; background-color: #fff; padding: 20px 10px; border: 1px solid #d3d3d3;"
                                    bgcolor="#fff"><span
                                            style="font-size: 18px; color: #80a2a6;">{{ trans('variables.phone') }}</span>
                                </td>
                                <td style="width: 50%; background-color: #fff; padding: 20px 10px; border: 1px solid #d3d3d3;"
                                    bgcolor="#fff"><span
                                            style="font-size: 18px; color: #80a2a6;">{{$data['phone'] or ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; background-color: #fff; padding: 20px 10px; border: 1px solid #d3d3d3;"
                                    bgcolor="#fff"><span style="font-size: 18px; color: #80a2a6;"> Email </span></td>
                                <td style="width: 50%; background-color: #fff; padding: 20px 10px; border: 1px solid #d3d3d3;"
                                    bgcolor="#fff"><span
                                            style="font-size: 18px; color: #80a2a6;">{{$data['email'] or ''}}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; min-height: 60px; max-height: 100000000000px; background-color: #bcebee; padding: 20px;"
            bgcolor="#bcebee">
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>