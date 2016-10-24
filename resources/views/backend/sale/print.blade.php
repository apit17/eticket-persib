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
<div style="width:80%">
    <table align="left">
        <tr>
            <td>
                <b>Sender :</b><br/>
                {{ucwords($data[0]->sender)}}<br/><br/>
                <b>Paid by :</b><br/>
                {{$data[0]->customer}} <br/>
                {{$data[0]->email}} <br/>
                {{$data[0]->phone}} <br/>
                {{$data[0]->address}} <br/>
            </td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td>Invoice <font size="3"><b>#{{$data[0]->code}}</b></font><br/><br/>
            <b>Date :</b><br/>
            {{date('F d, Y',strtotime($data[0]->date))}}
            </td>
        </tr>
    </table>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <table width="100%" align="center"product>
        <tr>
            <th class="product">No.</th>
            <th class="product">Product</th>
            <th class="product">Color</th>
            <th class="product">Quantity</th>
            <th class="product">Price</th>
            <th class="product">Amount</th>
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
                <td align="center" class="product" colspan="5"><b>Total Payment</b></td>
                <td align="center" class="product"><b><?php echo 'Rp. '.str_replace(',','.',number_format($total)); ?></b></td>
            </tr>
    </table>
    <br/><br/>
    <h3>Thank you for your trust.</h3>
</div>
</body>
</html>