<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Penerimaan</title>
    {{ HTML::style('assets_back/css/bootstrap.min.css') }}
    <style>
        @media print {
			body {
				font-family: Calibri;
                font-size: 9px;
			}
		}
    </style>
</head>
<body onload="window.print();">
    <table width="99%">
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">{{ $storage->name }}</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">LAPORAN PEMBELIAN PAKAN</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">PERIODE {{ date('d/m/Y', strtotime($from)) }} - {{ date('d/m/Y', strtotime($to)) }}</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">TGL</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">NO MOBIL</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">SUPPLIER</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">FAKTUR</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">JENIS</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">BALL</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">QTY (KG)</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">HARGA/KG</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">JUMLAH</td>
        </tr>
        <?php
            $tball   = 0;
            $tqty    = 0;
            $tjumlah = 0;
        ?>
        @foreach($data as $r)
        <tr>
            <td style="text-align: center; border: 1px solid #000;">{{ date('d-m-y', strtotime($r->date)) }}</td>
            <td style="border: 1px solid #000; padding-left: 2px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding-left: 2px;">{{ $r->supplier_name }}</td>
            <td style="border: 1px solid #000; padding-left: 2px;">{{ $r->number }}</td>
            <td style="border: 1px solid #000; padding-left: 2px;">{{ $r->item_name }}</td>
            <td style="text-align: right; border: 1px solid #000; padding-right: 2px;">{{ number_format(0,2,",",".") }}</td>
            <td style="text-align: right; border: 1px solid #000; padding-right: 2px;">{{ number_format($r->qty,2,",",".") }}</td>
            <td style="text-align: right; border: 1px solid #000; padding-right: 2px;">{{ number_format($r->price,2,",",".") }}</td>
            <td style="text-align: right; border: 1px solid #000; padding-right: 2px;">{{ number_format($r->qty*$r->price,2,",",".") }}</td>
        </tr>
        <?php
            $tball   = $tball + 0;
            $tqty    = $tqty + $r->qty;
            $tjumlah = $tjumlah + ($r->qty*$r->price);
        ?>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: center; font-weight: bold; border: 1px solid #000;">Total</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000; padding-right: 2px;">{{ number_format($tball,2,",",".") }}</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000; padding-right: 2px;">{{ number_format($tqty,2,",",".") }}</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000; padding-right: 2px;">&nbsp;</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000; padding-right: 2px;">{{ number_format($tjumlah,2,",",".") }}</td>
        </tr>
    </table>
</body>
</html>