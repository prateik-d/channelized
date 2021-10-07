<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" >
    <head>
        <!--[if gte mso 9]>
          <xml>
            <o:OfficeDocumentSettings>
              <o:AllowPNG />
              <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
          </xml>
        <![endif]-->
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="x-apple-disable-message-reformatting" />
        <!--[if !mso]><!-->
        <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" /> -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet" />
        <!--<![endif]-->
        <title>Verify link</title>
        <!--[if gte mso 9]>
          <style type="text/css" media="all">
            sup {
              font-size: 100% !important;
            }
          </style>
        <![endif]-->
    </head>
    <body class="body" style="background:#eaeff2;height: 100%; width: 100%; float: left;">
        <table style="float: left; width: 100%;height: 100%; padding:0 !important; margin:0px !important; display:block !important;  background:#eaeff2; -webkit-text-size-adjust:none;">
            <tbody style="width:100%; float: left">
                <tr style="width:100%; float: left">
                    <td style="width:100%; float: left">
                        <table width="700" style="width:700px !important; margin: 15px auto;" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <!-- header section  -->
                                <tr style="background-color:#ffffff;">
                                    <td>
                                        <table style="width:700px; margin:auto;" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td height="25"></td>
                                            </tr>
                                            <tr>
                                                <td style="color: #1B7F9D;font-weight: 500;padding:18px 46px; text-align: left; font-family: 'Poppins',sans-serif; font-size: 28px;">
                                                    We’re glad you’re here, {{$name}}.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="28"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 46px; font-size: 16px;font-weight: 300;  color: #424446; line-height: 25px;font-family: 'Poppins',sans-serif;">
                                                    You have successfully created a Channelised account.
                                                    Click on the link below to verify your email and start
                                                    enjoying Channelised.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="40"></td>
                                            </tr>
                                            <!-- Verify button -->
                                            <tr>
                                                <td style=" padding: 0px 46px;">
                                                    <a href="{{$url}}">
                                                        <img src="{{ asset('public/assets/images/verifyEmail.png') }}" alt="channelised-verify-button"/>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="40"></td>
                                            </tr>
                                            <!-- verify copy link -->
                                            <tr>
                                                <td style="padding: 0px 208px 0px 45px; font-size: 16px;font-weight: 300;  color: #424446; line-height: 25px;font-family: 'Poppins',sans-serif;    word-break: break-all;">
                                                    Or copy this link and paste in your web browser:
                                                    <span style="text-decoration:underline">
                                                        <a style="color:#424446" href="{{$url}}">
                                                            {{$url}}
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="88"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 208px 0px 45px;font-size: 16px;font-weight: 600;  color: #424446; line-height: 25px;font-family: 'Poppins',sans-serif;    word-break: break-all;">
                                                    Cheers,<br />The Channelised Team
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="95"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 25px 0px 25px;">
                                                    <table style="width:100%; float: left">
                                                        <tr>
                                                            <td height="2" style=" border-bottom:1px solid rgba(112,112,112,0.30);"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="75"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
