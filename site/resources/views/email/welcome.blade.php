<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Welcome to Ykings PBT!</title>
        <style>
            body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
            table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
            img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
            body{ margin:0 !important; padding:0 !important; background-color:#e4e9f0;}

            @media screen and (max-width: 640px) {
                .td-mob{
                    padding-left:0 ;
                    display:block !important;
                    text-align:center !important;
                    font:bold 14px Arial, sans-serif;
                }
            }
        </style>
    </head>

    <body>
        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ececec" border="0">
            <tr>
                <td valign="top" align="center">
                    <table cellpadding="0" cellspacing="0" width="100%" style="max-width:700px;">
                        <tr>
                            <td align="center" valign="top" style="padding:30px 0 30px">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF">
                                                <tr>
                                                    <td align="center" style="padding:90px 20px 80px">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td align="center" valign="top" style=" padding-bottom:58px">
                                                                    <img src="{{asset('img/yking.png')}}" alt="ykings">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style=" font:bold 24px Arial, sans-serif; color:#231f20; ">Welcome to Ykings PBT, <span style="color:#f6b220; display:inline-block; vertical-align:middle;padding-left:5px">{{$first_name}} {{$last_name}}</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" >Thanks for Joining <span style="font-weight:bold; color:#231f20">Ykings PBT!</span> Your password to login into the App is <b>{{ $password }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font:normal 16px Arial,sans-serif; color:#231f20;">If you have any problems, please contact us: <a href="#" style="text-decoration:none; color:#f6b220">info@ykings.com</a></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>                 
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" width="100%">
                                                <tr>
                                                    <td align="center" valign="top" style="padding:40px 15px 45px;">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td align="center" style=" padding-bottom:30px; font:normal 14px Arial,sans-serif; color:#919191;"> <a href="#" style=" color:#f6b220; display:inline-block; vertical-align:middle; padding-right:3px; text-decoration:underline;">Unsubscribe </a> From YKings Emails</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style=" padding-bottom:7px; font:normal 14px Arial,sans-serif; color:#919191;"> Ykings GmbH, Schöllerstr. 13, 72160 Horb am Neckar, Germany </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style=" font:normal 14px Arial,sans-serif; color:#919191;"> <a href="http://ykings.com/" style=" color:#f6b220; display:inline-block; vertical-align:middle; padding-right:30px; text-decoration:underline;">ykings.com </a> Email : info@ykings.com</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>

                    </table> 
                </td>
            </tr>
        </table>
    </body>
</html>
