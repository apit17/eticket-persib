<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>E-Ticket</title>
    <link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,300' rel='stylesheet' type='text/css'>
    <style type="text/css">
    .sos-med>ul {
    padding-left:0;
    margin-bottom:0;
    list-style:none;
    text-align: left;
    }
    .sos-med>ul>li {
    display:inline-block;
    }
    .sos-med>ul>li>a>img {
    transition:all 0.3s;
    -webkit-transition:all 0.3s;
    -moz-transition:all 0.3s;
    }
    .sos-med>ul>li>a:hover>img {
    transform:scale(1.12);
    -webkit-transform:scale(1.12);
    -moz-transform:scale(1.12);
    }

    </style>
</head>
<body style="background: #f3f3f3;margin:0;padding:0">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#f3f3f3">
    <tbody>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    <td>
    <table width="550"  cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
    <tbody>
    <tr bgcolor="#000080">
    <td style="padding:0 30px" colspan="2" align="center">
    <h2 style="color:#fff;font-family: 'Yanone Kaffeesatz', sans-serif;text-transform:uppercase;letter-spacing:1px">Informasi Jadwal Pertandingan</h2>
    </td>
    </tr>
    <tr>
    <td colspan="2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url({{ url('assets/buzzohero/email/bg_arrow.png') }}) no-repeat 30px 0">
    <tbody>
    <tr>
    <td width="30px">&nbsp;</td>
    <td  align="left" valign="top">
    <table width="100%" style="margin: 0 auto">
    <tbody>
    <tr>
    <td style="padding:40px 0 10px" align="center">
    <font style="font-family: 'Nunito', sans-serif;color:#000080; font-size:16px;">Halo <b>{{$name}}</b>, Persiapkan dirimu untuk pertandingan berikutnya dan segera pesan tiket di E-Ticket Persib</font>
    <p style="font-family: 'Nunito', sans-serif;color:#585858; font-size:14px;"></p>
    </td>
    </tr>
    <tr>
    <td align="center" style="padding: 10px 15px ;border:2px solid #000080;font-family: 'Nunito', sans-serif;color:#585858; font-size:14px;">
    <span style="color:#000080;font-weight:bold;">{{strtoupper($title)}}</span><br/><br/>
    <span style="color:#000080;font-weight:bold;">{{$description}}</span>
    <span style="color:#000080;font-weight:bold;">{{$date}}</span>
    </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
    <td align="center">
        <ul style="list-style: none;padding-left: 0;margin-bottom: 0;">
            <li>
                <a href="https://www.instagram.com/persib_official/"><img src="http://i.dailymail.co.uk/i/pix/2016/05/11/14/340ADB5400000578-3584623-image-a-28_1462973815643.jpg" width="200" height="150" /></a>
            </li>
        </ul>
    </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    </tbody>
    </table>
    </td>
    <td width="30px">&nbsp;</td>
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
    <td>
    <table width="550" cellspacing="0" cellpadding="0" align="center" style="margin-top: 10px; margin-bottom: 10px">
    <tbody>
    <tr>
    <td colspan="2" align="center">
    <p style="font-family: 'Nunito', sans-serif;color:#000080; font-size:24px;"><b>
    Bagimu PERSIB Jiwa Raga Kami</b>
    </p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr style="background:#e8e8e8;">
    <td align="center" colspan="2" style="padding:10px;">
    <font style="font-family: 'Nunito', sans-serif;color:#949494; font-size:12px;">&copy;Copyright 2017  E-Ticket Persib- <a href="https://www.instagram.com/apitgilang/" target="_blank">G3-Group3</a> | All right reserved</font>
    </td>
    </tr>
    </tbody>
    </table>
</body>
</html>