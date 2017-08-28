<!DOCTYPE html>
<html>
<head>
    <title>Invoice#{{$data->transaction_code}}</title>
    <style type="text/css">
        table .product {
            border-collapse: collapse;
        }

        table .product, th .product, td .product {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div style="width:100%">
    <table align="left">
        <tr>
            <td>
                <b>Pengirim : E-Ticket Persib (081235362979)</b><br/>
                <br/><br/>
                <b>Penerima :</b><br/>
                {{$data->customer->customer_name}} <br/>
                {{$data->customer->customer_email}} <br/>
                {{$data->customer->customer_handphone}} <br/>
                {{$data->customer->customer_address}} <br/>
            </td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td><b>Invoice Order :</b><font size="3"><br/>
            ID <b>#{{$data->transaction_code}}</b></font><br/><br/>
            <b>Tanggal :</b><br/>
            {{$date}}
            </td>
        </tr>
    </table>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <table width="100%" align="center">
            <tr>
                <th class="product">No.</th>
                <th class="product">Category Ticket</th>
                <th class="product">Match</th>
                <th class="product">Jumlah</th>
            </tr>
            <tr>
                <td align="center" class="product">1</td>
                <td align="center" class="product">{{ucwords($data->ticket->ticket_name)}}</td>
                <td align="center" class="product">{{ucwords($data->ticket->schedule->schedule_match)}}</td>
                <td align="center" class="product">1</td>
            </tr>
        </table>
        <br/><br/>
    <h4>Terima kasih atas kepercayaan Anda.</h4>
</div>
</body>
</html>