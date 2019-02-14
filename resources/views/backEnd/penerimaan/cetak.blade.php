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
            <td colspan="9" style="text-align: center; font-weight: bold;">MBA</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">LAPORAN PEMBELIAN PAKAN</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">PERIODE</td>
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
        <tr>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; border: 1px solid #000;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: center; font-weight: bold; border: 1px solid #000;">Total</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">&nbsp;</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">&nbsp;</td>
        </tr>
    </table>
</body>
</html>