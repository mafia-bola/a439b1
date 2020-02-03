@extends('admin.layouts.app')
@push('css')

@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$template->title}}                
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{$template->title}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title"><i class="{{$template->icon}}"></i> Detail {{$template->title}}</h3>                            
                        </div>
                        <div class="box-body">  
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:200px"></th>
                                        <th style="width:20px"></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>                                                                                       
                                        <tr>
                                            <td>No Surat</td>
                                            <td>:</td>
                                            <td>{{$data->no_surat}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Surat</td>
                                            <td>:</td>
                                            <td>{{$data->kodeSurat->id." (".$data->kodeSurat->keterangan.")"}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td>{{$data->kategori}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tipe</td>
                                            <td>:</td>
                                            <td>{{$data->tipe}}</td>
                                        </tr>
                                        <tr>
                                            <td>Judul</td>
                                            <td>:</td>
                                            <td>{{$data->judul}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>{{$data->keterangan}}</td>
                                        </tr>
                                        <tr>
                                            <td>File Surat</td>
                                            <td>:</td>
                                            <td><a href="{{asset($data->file_surat)}}" target="__blank" class="btn btn-sm btn-success">Lihat Surat</a></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>{{$data->status}}</td>
                                        </tr>
                                    </tbody>
                                </tbody>
                            </table>

                            <h2>Riwayat Disposisi</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dari User</th>
                                        <th>Ke User</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disposisi as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->dariUser->nama}}</td>
                                            <td>{{$item->keUser->nama}}</td>
                                            <td>{{date('d-m-Y H:i:s',strtotime($item->created_at))}}</td>
                                            <td>{!!$item->keterangan!!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="box-footer">                                
                            <form action="{{route('disposisi.store')}}" method="post">
                                @csrf
                                {!!Render::form(['type' => 'ckeditor','name' => 'keterangan','label' =>'Keterangan Disposisi'])!!}
                                <input type="hidden" name="surat_id" value="{{$data->id}}">
                                <button class="btn btn-success" name="action" value="acc">Acc Surat</button>
                                <button class="btn btn-warning" name="action" value="turunkan">Turunkan Surat</button>
                                <a href="{{ url()->previous() }}" class="btn btn-default pull-right">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('js')
    <!-- page script -->
     <script>
        var map, marker;
         function initMap(){
            console.log('INIT MAP');
            var myLatLng = {lat: {{$data->lat}}, lng: {{$data->lng}} };         
            $('.lat').val(myLatLng.lat);
            $('.lng').val(myLatLng.lng); 
            map = new google.maps.Map(document.getElementById('google_map'), {
                zoom: 16,
                center: myLatLng
            });  

            marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                draggable:false,
                title: 'Lokasi Desa'
            });
            marker.setPosition(event.latLng);
        }
    </script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDX5i1N1RR3DSQTIRu0ZbIyTgorg7Rhg_g&callback=initMap"></script>
    <script>
    $(function () {
        $('#datatables').DataTable()
        $('#full-datatables').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })
    </script>
@endpush