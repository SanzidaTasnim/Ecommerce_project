<html>

<head>
  <META http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
  <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;background:#e9e9e9;padding:50px 0px">
    <tr>
      <td>
        <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;background:#ffffff;padding:0px 25px">
          <tbody>
            <tr>
              <td style="margin:0;padding:0">
                <table border="0" cellpadding="20" cellspacing="0" width="100%" style="background:#ffffff;color:#1a1a1a;line-height:150%;text-align:center;border-bottom:1px solid #e9e9e9;font-family:300 14px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif">
                  {{-- <tbody>
                    <tr>
                      <td valign="top" align="center" width="100" style="background-color:#ffffff">
                        <img alt="Swiggy" style="width:134px" src="https://res.cloudinary.com/swiggy/image/upload/v1447855171/Swiggy-logo_yc2umc.png">
                      </td>
                    </tr>
                  </tbody> --}}
                </table>

                <br>

                <table border="0" cellpadding="" cellspacing="0" width="100%" style="background:#ffffff;color:#000000;line-height:150%;text-align:center;font:300 16px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif">
                  <tbody>
                    <tr>
                      <td valign="top" width="100">
                        <h3 style="text-align:center;text-transform:uppercase">Fast Shopping</h3>
                        <p>Payment method: <span style="font-size:18px;font-weight:bold">PayTM </span></p>
                        <p>Last Delivery Boy: <span style="font-size:18px;font-weight:bold">NA</span></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <table border="0" cellpadding="20" cellspacing="0" width="100%" style="color:#000000;line-height:150%;text-align:left;font:300 16px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif">
                  <tbody>
                    <tr>
                      <td valign="top" style="font-size:24px;">
                        <span style="text-decoration:underline;">Order No: #1057053696</span>
                        <h2 style="display:inline-block;font-family:Arial;font-size:24px;font-weight:bold;margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-align:left;line-height:100%">
                            ({{$order->created_at}})
                        </h2>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table align="center" cellspacing="0" cellpadding="6" width="95%" style="border:0;color:#000000;line-height:150%;text-align:left;font:300 14px/30px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;" border=".5px">
                  <thead>
                    <tr style="background:#efefef">
                      <th scope="col" width="30%" style="text-align:left;border:1px solid #eee">Product</th>
                      <th scope="col" width="15%" style="text-align:right;border:1px solid #eee">Quantity</th>
                      <th scope="col" width="20%" style="text-align:right;border:1px solid #eee">Price</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr width="100%">
                      <td width="30%" style="text-align:left;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0;word-wrap:break-word">
                        {{$order->product_title}}
                      </td>
                      <td width="15%" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">
                        {{$order->quantity}}
                      </td>
                      <td width="20%" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span>{{$order->price}}Tk</span></td>
                    </tr>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th scope="row" colspan="2" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">Cart Subtotal </th>
                      <th style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span>{{$order->price}}Tk</span></th>
                    </tr>
                    <tr>
                      <th scope="row" colspan="2" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">
                        Vat</th>
                      <td style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0">
                        <span>
                            <?php $vPrice= (5/100) * $order->price;?>
                            {{ $vPrice }}
                        </span>
                    </td>
                    </tr>
                    <tr>
                      <th scope="row" colspan="2" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">
                        Packing Charges</th>
                      <td style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span>20tk</span></td>
                    </tr>

                    <tr>
                      <th scope="row" colspan="2" style="text-align:right;background:#efefef;text-align:right;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">Order Total</th>
                      <td style="background:#efefef;text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0;color:#7db701;font-weight:bold">
                        <span>
                            <?php $totalPrice = $vPrice + $order->price + 20 ; ?>

                            {{ $totalPrice}}Tk
                        </span>
                    </td>
                    </tr>
                  </tfoot>
                </table>
                <br>
                <br>
                <table border="0" cellpadding="20" cellspacing="0" width="100%" style="color:#000000;line-height:150%;text-align:left;font:300 14px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif">
                  <tbody>
                    <tr>
                      <td valign="top">
                        <h4 style="font-size:24px;margin:0;padding:0;margin-bottom:10px;">Customer Details</h4>
                        <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Email:</strong> <a href="mailto:{{$order->email}}" target="_blank">{{$order->email}}</a></p>
                        <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Tel:</strong>{{$order->phone}}</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table border="0" cellpadding="20" cellspacing="0" width="100%" style="color:#000000;line-height:150%;text-align:left;font:300 14px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif">
                  <tbody>
                    <tr>
                      <td valign="top">
                        <h4 style="font-size:24px;margin:0;padding:0;margin-bottom:10px;">Delivery address</h4>
                        <p>
                          {{$order->name}}
                          <br /> {{$order->address}}
                          <br />
                          <br /> Bajaj Maruti Residency 2nd Left
                          <br /> H-2-9310, White Field Rd
                        </p>
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
  </table>
</body>

</html>
