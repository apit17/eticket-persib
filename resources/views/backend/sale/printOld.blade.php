<!DOCTYPE html>
<html>
<head>
    <title>Invoice#{{$data[0]->code}}</title>
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
                <b>Pengirim :</b><br/>
                {{ucwords($data[0]->sender)}}<br/><br/>
                <b>Penerima :</b><br/>
                {{$data[0]->customer}} <br/>
                {{$data[0]->email}} <br/>
                {{$data[0]->phone}} <br/>
                {{$data[0]->address}} <br/>
            </td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td><b>Invoice Order :</b><font size="3"><br/>
            ID <b>#{{$data[0]->code}}</b></font><br/><br/>
            <b>Tanggal :</b><br/>
            {{$date}}
            </td>
        </tr>
    </table>
    @if($data[0]->sender == 'Kissproof.id')
        <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <table width="100%" align="center">
            <tr>
                <th class="product">No.</th>
                <th class="product">Produk</th>
                <th class="product">Warna</th>
                <th class="product">Quantitas</th>
                <th class="product">Harga</th>
                <th class="product">Jumlah</th>
            </tr>
                <?php
                    $total = 0;
                ?>
                @foreach($data as $i => $val)
                    <tr>
                        <td align="center" class="product">{{$i+1}}</td>
                        <td align="center" class="product">{{ucwords($val->product)}}</td>
                        <td align="center" class="product">{{ucwords($val->color)}}</td>
                        <td align="center" class="product">{{$val->qty}}</td>
                        <td align="center" class="product"><?php echo 'Rp. '.str_replace(',','.',number_format($val->price)); ?> </td>
                        <td align="center" class="product"><?php echo 'Rp. '.str_replace(',','.',number_format($val->price*$val->qty)); ?> </td>
                    </tr>
                    <?php
                        $total += $val->price*$val->qty;
                    ?>
                @endforeach
                <tr>
                    <td align="center" class="product" colspan="5"><b>Total Pembayaran</b></td>
                    <td align="center" class="product"><b><?php echo 'Rp. '.str_replace(',','.',number_format($total)); ?></b></td>
                </tr>
        </table>
        <br/><br/>
        <h4>Terima kasih atas kepercayaan Anda.</h4>
    @else
        <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <h4>Terima kasih atas kepercayaan Anda.</h4>
    @endif
</div>
</body>
</html>