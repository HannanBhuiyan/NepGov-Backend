

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>nepgov email</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        </head>
        <style>
            body {
            margin: 0;
            }
            table {
            border-spacing: 0;
            }
            td {
            padding: 0;
            }
            img {
            border: 0;
            }
            
            
        </style>
        <body>
            
            <div class="row">
                <div class="col-8 m-auto">
                    <center class="wrapper" style="background:#fff;width: 100%; table-layout: fixed">
                        <table style="margin: 0 auto;
                        width: 100%;
                        max-width: 640px;
                        text-align: center;">
                        <tr>
                            <td style="padding: 40px;
                            font-size: 40px;
                            color: red;
                            font-weight: bold;">
                            <img src="https://i.postimg.cc/9fQBXdGp/Logo.png" alt="" width="141px" height="36px"></td>
                        </tr>
                        <tr>
                            <td>
                            <img
                                width="200px"
                                src="https://i.postimg.cc/Qt8qx93H/Screenshot-1.png"
                                alt="" width="200px" height="171px"
                            />
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 30px;
                            padding-top: 20px;
                            font-weight: 700">{{$userSurvay->title ?? ''}}!</td>
                        </tr>
                        
                        <tr>
                            <td style="font-size: 18px;
                            padding: 30px 0px 50px;
                            color: gray;">
                            {{$userSurvay->short_para ?? ''}}
                            </td>
                        </tr>
                
                        <tr>
                            <table style="background-color: #F8F7FB;
                            padding-bottom: 30px;
                            width: 100%;
                            max-width: 600px;
                            text-align: center;" width="100%">
                            <tr>
                                <td>
                                <span>
                                    <a  style="background-color: #ED492A;
                                    padding: 15px 60px;
                                    color: white;
                                    font-size: 22px;
                                    border-radius: 2px;
                                    font-weight: bold;
                                    display: inline-block;
                                    margin-top: 20px;
                                    text-decoration: none;" href="https://staging.nepgov.com/normal-vote/{{ $slug ?? "" }}">{{$userSurvay->footer_title ?? ''}}</a>
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #BBADC5;
                                padding: 35px 0;">
                                {{$userSurvay->footer_para ?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <a style="color: orangered;
                                text-decoration: none;" href="{{$userSurvay->short_para ?? ''}}">{{$userSurvay->footer_link ?? ''}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <hr/>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;
                                color: gray;
                                text-align: start;
                                padding-left: 30px;
                                padding-right: 30px;">
                                This email was intended for
                                <span style="color: navy;">{{$userSurvay->email_address ?? ''}}</span>. You received this email
                                because you signed up to receive surveys from YouGov. Do not
                                reply to this email - to contact us please select 'Contact'
                                below.
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;
                                color: gray;
                                text-align: start;
                                padding-left: 30px;
                                padding-top: 30px;">50 Block, NewYork City</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;
                                color: gray;
                                text-align: start;
                                padding-left: 30px; padding-bottom: 30px">NewYork, United State</td>
                            </tr>
                            </table>
                        </tr>
                        </table>
                    </center>
                    {{-- <div class="text-center" style="text-align: center; width: 600px; margin-left: 325px; margin-top: 20px" >
                        <a class="btn btn-dark" href="{{route('template')}}" style="width: 100%">back</a>
                    </div> --}}
                </div>
            </div>
            
        </body>
    </html>