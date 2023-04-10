<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NevGov</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/images/brand/favicon.ico" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

        <style>
            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: 'DM Sans', sans-serif;
            }

            body{
                background: #ccc;
            }

            table{
            border-collapse: collapse;
            }

            td{
                padding: 0;
            }
            /* a{
                text-decoration: none;
                color: #666;
            } */



        </style>
    </head>

    <div class="container">
        <div class="col-lg-12" style="margin-top: 100px">
            
    
            <!-- padding -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; height: 30px; margin: auto; background: #fff;">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- padding -->
    
            
            <!-- template header -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="width: 200px;"></td>
                                <td style="text-align: center;"><a style=" color:tomato; font-size: 30px; font-weight: 600;" href="#!"><img src="https://i.postimg.cc/9fQBXdGp/Logo.png" alt="NepGov Logo" width="141px" height="36px"></a></td>
                                <td style="width: 200px;"></td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
            </table>
            <!-- template header -->
    
    
            <!-- padding -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; height: 40px; margin: auto; background: #fff;">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- padding -->
    
            <!-- title -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="width: 40px;"></td>
                                <td style="text-align: center; font-size: 20px; font-weight: 700;">{{$forgetPassword->title ?? ''}}:-</td>
                                <td style="width: 40px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- title -->
    
    
            <!-- padding -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; height: 30px; margin: auto; background: #fff;">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- padding -->
    
            <!-- verification code -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="text-align: center; font-size: 30px; font-weight: bold;"><a href="{{ route('reset.password.get', $token) }}">{{$forgetPassword->reset_link_text ?? ''}}</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- verification code -->
    
    
            <!-- padding -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; height: 30px; margin: auto; background: #fff;">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- padding -->
    
            <!-- padding -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; height: 50px; margin: auto; background: #fff;">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- padding -->
    
    
            <!-- footer-->
    
            <!-- padding -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; height: 40px; margin: auto; background:#F8F7FC">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- padding -->
    
    
            <!-- footer main -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #F8F7FC;">
                            <tr>
                                <td style="width: 40px;"></td>
                                <td style="font-size: 14px; font-weight: 400; color: gray;">NepGov Service LTD </td>
                                <td style="width: 40px;"></td>
                            </tr>
                            <tr>
                                <td style="width: 40px;"></td>
                                <td style="font-size: 14px; font-weight: 400; color: gray;">50 Block, NewYork City, NewYork, United State </td>
                                <td style="width: 40px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
    
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #F8F7FC;">
                            <tr>
                                <td style="height: 0px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
    
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #F8F7FC;">
                            <tr style="height: 100px">
                                <td style="width: 40px;"></td>
                                <td style="font-size: 16px; color: gray;">
                                    <a style="color: gray;" href="javascript:void(0)">Privacy</a> 
                                    {{-- <a style="color: gray;" href="https://nepgov.vercel.app/privacyPolicyPage">Privacy</a>  --}}
                                </td>
                                <td style="width: 40px;"></td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
            </table>
           {{-- <div class="text-center" style="text-align: center; width: 650px; margin-left: 215px; margin-top: 20px" >
            <a class="btn btn-dark" href="{{route('template')}}" style="width: 100%">back</a>
           </div> --}}
            <!-- footer main -->
    
            <!-- footer-->
    
            <!-- top gap table -->
            <table style="height: 40px;">
                <tr>
                    <td>
                       
                    </td>
                </tr>
            </table>
            <!-- top gap table -->
    
        </div>
    </div>