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
                                    <h4 class="text-navy">{{$sedekah->code}} </h4>
                                    <address>
                                        <h4><strong>{{$sedekah->perusahaan}}</strong></h4>
                                       {{$sedekah->keterangan}}
                                    </address>
                                    <p>
                                       
                                        <span><strong>Tgl:</strong> {{ $sedekah->created_at }}</span>
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
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($details as $detail)
                                       <tr>
                                         <td>{{ $detail->sampah }}</td>
                                         <td>{{ $detail->jumlah}}</td>
                                         <td>{{ $detail->satuan}}</td>
                                         <td>{{ number_format($detail->harga_beli,0)}}</td>
                                         <td>{{ number_format($detail->nilai_rp,0)}}</td>

                                       </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Total (Rp.):</strong></td>
                                    <td>{{ number_format($sedekah->total_rp,0) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total (kg) :</strong></td>
                                    <td>{{ number_format($sedekah->total_kg) }}</td>
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
