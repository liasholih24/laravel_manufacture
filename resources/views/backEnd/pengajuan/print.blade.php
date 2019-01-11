@extends('backLayout.appprint')
<?php
    header('Content-type: text/plain');
?>
@section('style')
 {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
                <div class="wrapper wrapper-content p-xl">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>PD. Kebersihan Kota Bandung</strong><br>
                                        Jl. Babakan Sari No. 64 Kebaktian<br>
                                        Bandung<br>
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4 class="text-navy">{{$transfer->code}} </h4>
                                    <address>
                                       {{$transfer->keterangan}}
                                    </address>
                                    <p>
                                        <span><strong>Gudang Asal:</strong> {{ $transfer->gudangfrom->name }}</span><br>
                                        <span><strong>Gudang Tujuan:</strong> {{ $transfer->gudangto->name }}</span><br>
                                        <span><strong>Tgl:</strong> {{ $transfer->created_at }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Sampah</th>
                                        <th>Jumlah </th>
                                        <th>Satuan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($details as $detail)
                                       <tr>
                                         <td>{{ $detail->sampah }}</td>
                                         <td>{{ $detail->jumlah}}</td>
                                         <td>{{ $detail->satuan}}</td>

                                       </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                
                                <tr>
                                    <td><strong>Total (kg) :</strong></td>
                                    <td>{{ number_format($transfer->total_kg) }}</td>
                                </tr>
                                
                                </tbody>
                            </table>
                           
                            <br/>
                            
                            <div class="well m-t"><strong>Keterangan</strong>
                                Slip ini dikeluarkan oleh sistem dan merupakan bukti yang sah dalam transaksi.
                            </div>
                        </div>

                  </div>

@section('script')

{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}

<!-- Page-Level Scripts -->
<script>
    window.print();
     $(document).ready(function(){

    });

</script>
@endsection
