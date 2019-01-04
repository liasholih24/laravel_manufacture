@extends('backLayout.appprint')
<?php
    header('Content-type: text/plain');
?>
@section('style')
<style type="text/css">
  .ibox-content {
   border-color: #fff !important;
}
.tbl > tbody > tr > td, .tbl > tfoot > tr > td {
    border-top: 1px solid #fff !important;
    font-family: "Times New Roman", Times, serif;
    font-size: 12px;
    margin-left: 4.5mm;
    margin-right: 15.5mm;
    margin-top: 10.5mm;
    margin-bottom: 19mm;
    
}
.tbl > thead > tr > th {
    border-bottom: 1px solid #fff !important;
}



</style>
<style type="text/css" media="print">
@page
{
        size: A4 portrait;
        font-family: "Times New Roman", Times, serif;
        font-size: 0.5em;
        margin-left: 3mm;
        margin-right: 15mm;
        margin-top: 18mm;
        margin-bottom: 2mm;
}
.noprint{
  display: none !important;
}
table {
  table-layout: fixed;
  width: 20vh;
}
thead th:nth-child(1) {
  width: 3.5vh;
}
thead th:nth-child(2) {
  width: 11vh;
}
thead th:nth-child(3) {
  width: 12vh;

}
thead th:nth-child(4) {
  width: 12vh;
}
thead th:nth-child(5) {
  width: 13vh;
}
thead th:nth-child(6) {
  width: 11vh;
}
thead th:nth-child(7) {
  width: 11vh;
}
</style>
@endsection
                <div class="wrapper wrapper-content ">
                    <div class="">
                            <div class="">
                                <table class="tbl" width="100%">
                                  <thead>
                                    <th width="5%"></th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                    <th width="10%"></th>
                                    <th width="20%"></th>
                                  </thead>
                                  <tbody>
                                 <?php $i= $p;$addRow=true?>
                                   @foreach($riwayats as $riwayat)
                                 <?php $i++?>

                              @if($riwayat->print_code && $addRow)
                                 @php
                                 $addRow=false;
                                 @endphp
                              <tr>
                                <td class="no">&nbsp;</td>
                                <td class="tgl"></td>
                                <td class="kredit"></td>
                                <td class="debit"></td>
                                <td class="rp"></td>
                                <td class="kg"></td>
                                <td class="ket"></td>
                              </tr>   
                             @endif

                              <tr>
                                <td class="no">{{ !empty($riwayat->print_code)?"&nbsp;":$i }}</td>
                                <td class="tgl">{{ !empty($riwayat->print_code)?" ": $riwayat->created_at->format('d/m/Y') }}</td>
                                <td class="kredit">{{ !empty($riwayat->print_code)?" ": number_format($riwayat->kredit, 0) }}</td>
                                <td class="debit">{{ !empty($riwayat->print_code)?" ": number_format($riwayat->debit, 0) }}</td>
                                <td class="rp">{{ !empty($riwayat->print_code)?" ": number_format($riwayat->saldo, 0) }}</td>
                                <td class="kg">{{ !empty($riwayat->print_code)?"  ": $riwayat->saldo_sampah }}</td>
                                <td class="ket">lorem ipsum dolor sit amet</td>
                              </tr>
                                
                                  @endforeach
                                    </tbody>
                                </table>

                               <div class="noprint">{{ $riwayats->links() }}</div>
                            </div><!-- /table-responsive -->

                      
                      
                        </div>
    </div>

@section('script')
<!-- Page-Level Scripts -->
<script>

     window.print();
     window.reload();
     $(document).ready(function(){

    });

</script>
@endsection
