
<!-- print.html -->
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
        }
        .wrapper{
            width: 424px;
            height: 600px;
            background: #fff;
            position: relative;
            padding: 30px 40px;
            border: 0.5px solid black;
        }
        .border-design{
            display: flex;
            width: 100%;
            justify-content: flex-end;
        }
        .border-design .c1,
        .border-design .c2,
        .border-design .c3,
        .border-design .c4,
        .border-design .c5{
            width: 30px;
            height: 10px;
        }
        .c1, .c5{
            background: #ec8e1d;
        }
        .c2{
            background: #27aae2;
        }
        .c3{
            background: #fef200;
        }
        .c4{
            background: #d25a29;
        }
        .border-design.top{
            position: absolute;
            top: 0;
            right: 0;
        }
        .border-design.bottom{
            position: absolute;
            bottom: 0;
            left: 0;
            flex-direction: row-reverse;
        }
        .invoice-header{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
        .logo{
            text-transform: uppercase;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -1px;
        }
        .logo span{
            font-weight: 400;
        }
        .title{
            text-transform: uppercase;
            font-size: 25px;
            font-weight: 600;
            text-align: right;
        }
        .inv-number, .inv-date{
            display: flex;
            /* justify-content: space-between; */
        }
        .inv-number{
            padding: 10px 45px 0 0;
        }
        .inv-date{
            padding: 10px 0 0 45px;
        }
        .inv-number h3, .inv-date h3{
            font-size: 12px;
            font-weight: 700;
        }
        .inv-number h4, .inv-date h4{
            font-size: 12px;
            font-weight: 500;
        }
        .billing-detail{
            margin-top: 15px;
        }
        .billing-detail p:nth-child(1),
        .billing-detail p:nth-child(2){
            text-transform: uppercase;
        }
        .billing-detail p:nth-child(1){
            font-size: 10px;
        }
        .billing-detail p:nth-child(2){
            font-size: 12px;
            font-weight: 700;
            width: 150px;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }
        .billing-detail p:nth-child(3),
        .billing-detail p:nth-child(4),
        .billing-detail p:nth-child(5){
            font-size: 10px;
        }
        .billing-detail p span{
            font-weight: 600;
        }
        table{
            border-collapse: collapse;
            font-size: 12px;
            width: 100%;
            margin-top: 40px;
        }
        table thead tr td{
            text-align: center;
            font-weight: 600;
            padding: 8px 5px;
        }
        table tbody td{
            padding: 7px 5px;
            text-align: center;
        }
        .l-col{
            text-align: center;
            font-weight: 600;
        }
        .r-col{
                text-align: right;
        }
        table tbody tr:nth-child(odd){
            background: #f0f0f0;
        }
        table tbody tr:nth-child(even){
            background: #fcfcfc;
            border-bottom: 1px solid #b4b4b4;
            border-top: 1px solid #b4b4b4;
        }
        .total-section{
            position: absolute;
            right: 40px;
            font-size: 12px;
            width: 160px;
            margin-top: 5px;
            padding-right: 5px;
        }
        .sub, .tax, .total{
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }
        .total{
            border-top: 1px solid #646464;
            padding-top: 5px;
        }
        .sub p:nth-child(1),
        .tax p:nth-child(1),
        .total p{
            font-weight: 600;
        }
        .payment-terms{
            position: absolute;
            bottom: 30px;
            width: 45%;
        }
        .payment-detail{
            margin-bottom: 15px;
        }
        .payment-detail p:nth-child(1){
            font-size: 12px;
            font-weight: 700;
            width: 150px;
        }
        .payment-detail p:nth-child(2),
        .payment-detail p:nth-child(3),
        .payment-detail p:nth-child(4){
            font-size: 10px;
        }
        .payment-detail p span{
            font-weight: 600;
        }
        .terms p:nth-child(1){
            font-size: 12px;
            font-weight: 700;
            width: 150px;
        }
        .terms{
            margin-bottom: 15px;
        }
        .terms p:nth-child(2){
            font-size: 10px;
        }
        .terms p:nth-child(3){
            font-size: 10px;
        }
        .message p{
            font-size: 12px;
            font-weight: 700;
        }
        .signature p{
            font-size: 12px;
            font-weight: 700;
            position: absolute;
            right: 40px;
            bottom: 30px;
            border-top: 1px solid #262626;
        }
    </style>
    <body>
        <div class="wrapper">
            <div class="border-design top">
                <div class="c1"></div>
                <div class="c2"></div>
                <div class="c3"></div>
                <div class="c4"></div>
                <div class="c5"></div>
            </div>


            <div class="invoice-header">
                <div class="logo">GYM <span>Name</span></div>
                <div class="title">Receipt</div>
                <div class="inv-number">
                    <h3>Receipt #</h3>
                    <h4>&nbsp;&nbsp;36245</h4>
                </div>
                <div class="inv-date">
                    <h3>Date.</h3>
                    <h4>&nbsp;&nbsp;22/8/2023</h4>
                </div>
            </div>

            <div class="billing-detail">
                <p>Billing to</p>
                <p>ABC</p>
                <p><span>Contact:</span>&nbsp;123456789</p>
                <p><span>E-Mail:</span>&nbsp;name@mail.com</p>
                <!-- <p><span>Address</span>123 Street #1, City</p> -->
            </div>


            <table>
                <thead>
                    <tr>
                    <td>Particulars</td><td></td><td>Price</td><td></td><td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="l-col">Membership Type</td><td>Monthly</td><td>10000.00</td><td><td class="r-col"></td></td></tr>
                    <tr><td class="l-col">Fees</td><td></td><td></td><td><td class="r-col">10000.00</td></td></tr>
                    <tr><td class="l-col">Total Paid</td><td></td><td></td><td><td class="r-col">5000.00</td></td></tr>
                    <tr><td class="l-col">Remaining</td><td></td><td></td><td><td class="r-col">5000.00</td></td></tr>
                    <!-- <tr><td class="1-col">Balance</td><td></td><td></td><td><td class="r-col">5000.00</td></td></tr> -->
                </tbody>
            </table>


            <div class="total-section">
                <div class="sub">
                    <p>Balance:</p>
                    <p>5000.00</p>
                </div>
                <div class="tax">
                    <p>Tax</p>
                    <p>0.00</p>
                </div>
                <div class="total">
                    <p>Grand Total:</p>
                    <p>5000.00</p>
                </div>
            </div>


            <div class="payment-terms">
                <div class="payment-detail">
                    <p>Payment Info</p>
                    <p><span>Mode #</span> Cash</p>
                    <!-- <p><span>A/c Name</span> abcd</p>
                    <p><span>Bank</span> abcdef</p> -->
                </div>
                <div class="terms">
                    <!-- <p>Terms & Conditions</p> -->
                    <p>Gym Name</p>
                    <!-- <p>Gym Name</p> -->
                    <p>Address</p>
                </div>
                <div class="message">
                    <p>Thank You</p>
                    <p>Enjoy Your Membership</p>
                </div>
            </div>

            <div class="signature">
                <p>Authorized signature</p>
            </div>

            <div class="border-design bottom">
                <div class="c1"></div>
                <div class="c2"></div>
                <div class="c3"></div>
                <div class="c4"></div>
                <div class="c5"></div>
            </div>
        </div>
    </body>
    </html>

