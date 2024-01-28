<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #5D6975;
        text-decoration: underline;
    }

    body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: Arial;
    }

    header {
        padding: 10px 0;
        margin-bottom: 30px;
    }

    #logo {
        text-align: center;
        margin-bottom: 10px;
    }

    #logo img {
        width: 90px;
    }

    h1 {
        border-top: 1px solid #5D6975;
        border-bottom: 1px solid #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
    }

    #project {
        float: left;
    }

    #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
    }

    #company {
        float: right;
        text-align: right;
    }

    #project div,
    #company div {
        white-space: nowrap;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
        background: #F5F5F5;
    }

    table th,
    table td {
        text-align: center;
    }

    table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
    }

    table .service,
    table .desc {
        text-align: left;
    }

    table td {
        padding: 20px;
        text-align: right;
    }

    table td.service,
    table td.desc {
        vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table td.grand {
        border-top: 1px solid #5D6975;
        ;
    }

    #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
    }

    footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
    }

</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AMNESTY RECEIPT</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="../assets/img/logos/logo.jpg">
        </div>
        <h1>{{config('Remita.AMNESTY_DESCRIPTION')}}</h1>

        <div id="project">

            <div><span>Full Name</span> {{ auth()->user()->fullName }}
            </div>
            <div><span>PHONE</span> {{ auth()->user()->p_number }}</div>
            <div><span>EMAIL</span> {{ auth()->user()->email }}</div>

        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">TRANSACTION ID</th>
                    <th>Full Name</th>
                    <th class="desc">DESCRIPTION</th>
                    <th>RRR</th>
                    <th>AMOUNT(N)</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="service">{{ $transactionId }}</td>
                    <td class="desc">{{ $fullName }}</td>
                    <td class="desc">{{ $resource }}</td>
                    <td class="unit">{{ $rrr }}</td>
                    <td class="qty">{{ $amount }}</td>

                </tr>



            </tbody>
        </table>
        <div id="notices">

            <div align="center"> {!! QrCode::size(100)->generate($fullName . ' Remita: ' . $rrr . ' Amount: ' . $amount) !!}</div>

        </div>
    </main>
    <footer>
        <center>
            <h1>&copy;CIT Wufpbk- {{ date('Y') }}</h1>
        </center>
    </footer>
</body>

<script>
    window.print();
</script>
</html>
