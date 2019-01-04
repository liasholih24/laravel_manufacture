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
                                    <h4 class="text-navy">{{$tabungan->trx_code}} </h4>
                                    <address>
                                        <h4><strong>{{$tabungan->norek}} - {{$tabungan->getnasabah->nama_depan}}</strong></h4>
                                    </address>
                                    <p>
                                        <span><strong>Unit:</strong> {{$tabungan->getnasabah->group_code}} - {{$tabungan->getnasabah->getgroup->name}}</span><br/>
                                        <span><strong>Tgl:</strong> {{ $tabungan->created_at }}</span>
                                    </p>
                                </div>
                            </div>
                            @if($tabungan->code == "K")
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
                                    <td>{{ number_format($tabungan->kredit,0) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total (kg) :</strong></td>
                                    <td>{{ number_format($tabungan->saldo_sampah) }}</td>
                                </tr>
                                
                                </tbody>
                            </table>
                            @else
                            <div class="row ">
                                <div class="col-sm-6">
                                  <h2>Debit : Rp. {{number_format($tabungan->debit)}}</h2>
                                </div>
                            </div>
                            @endif
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
