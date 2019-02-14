<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Penjualan</title>
    {{ HTML::style('assets_back/css/bootstrap.min.css') }}
    <style>
        @media print {
			body {
				font-family: Courier New;
                font-size: 10px;
			}
		}
    </style>
</head>
<body onload="window.print();">
    <table width="99%">
        <tr>
            <td colspan="6" style="text-align: center; font-weight: bold;">{{ $storage->name }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center; font-weight: bold;">LAPORAN PENJUALAN TELUR BAGUS</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center; font-weight: bold;">PERIODE {{ date('d/m/Y', strtotime($from)) }} - {{ date('d/m/Y', strtotime($to)) }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center; font-weight: bold;">&nbsp;</td>
        </tr>
        <tr style="line-height: 30px; border-top: 1px dashed #000; border-bottom: 1px dashed #000;">
            <td style="text-align: center; font-weight: bold;">TANGGAL</td>
            <td style="text-align: center; font-weight: bold;">N.BUKTI</td>
            <td style="font-weight: bold;">KETERANGAN</td>
            <td style="text-align: center; font-weight: bold;">QUANTITY</td>
            <td style="text-align: center; font-weight: bold;">HARGA</td>
            <td style="text-align: center; font-weight: bold;">JUMLAH</td>
        </tr>
        <?php 
            $tqty    = 0;
            $tjumlah = 0;
        ?>
        @foreach($data as $r)
        <tr>
            <td style="text-align: center;">{{ date('d-m-y', strtotime($r->date)) }}</td>
            <td style="text-align: center;">{{ $r->number }}</td>
            <td>{{ $r->desc }}</td>
            <td style="text-align: right;">{{ number_format($r->qty,2,",",".") }}</td>
            <td style="text-align: right;">{{ number_format($r->price,2,",",".") }}</td>
            <td style="text-align: right;">{{ number_format($r->qty*$r->price,2,",",".") }}</td>
        </tr>
        <?php 
            $tqty    = $tqty + $r->qty;
            $tjumlah = $tjumlah + ($r->qty*$r->price);
        ?>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: center; font-weight: bold; border-top: 1px dashed #000;">&nbsp;</td>
            <td style="text-align: right; font-weight: bold; border-top: 1px dashed #000;">{{ number_format($tqty,2,",",".") }}</td>
            <td style="text-align: center; font-weight: bold; border-top: 1px dashed #000;">&nbsp;</td>
            <td style="text-align: right; font-weight: bold; border-top: 1px dashed #000;">{{ number_format($tjumlah,2,",",".") }}</td>
        </tr>
    </table>
</body>
</html>