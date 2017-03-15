@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div class="col-md-12">
    <h1 class="page-header">Chi tiêt
        <small>{{$phong->TenPhong}}</small>
    </h1>

    <form action="admin/phong/sua/{{$phong->id}}" method="POST">
        @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <label>Tên phòng</label>
            <input class="form-control" name="TenPhong" placeholder="Nhập tên phòng" value="{{$phong->TenPhong}}" />
        </div>
        <div class="form-group">
            <label>Bộ môn</label>
            <select name="idBoMon" class="form-control">
                @foreach($bomon as $bm)
                    <option
                    @if($bm->id == $phong->idBoMon)
                        {{"selected"}}
                    @endif
                     value="{{$bm->id}}">{{$bm->TenBM}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>RAM</label>
            <input type="number" class="form-control" name="DLRam" placeholder="Nhập dung lượng RAM" value="{{$phong->DLRam}}" />
        </div>
        <div class="form-group">
            <label>Ổ cứng</label>
            <input type="number" class="form-control" name="DLOCung" placeholder="Nhập dung lượng ổ cứng" value="{{$phong->DLOCung}}" />
        </div>
        <div class="form-group">
            <label>CPU</label>
            <input class="form-control" name="CPU" placeholder="Nhập thông tin CPU" value="{{$phong->CPU}}" />
        </div>
        <div class="form-group">
            <label>GPU</label>
            <input class="form-control" name="GPU" placeholder="Nhập thông tin GPU" value="{{$phong->GPU}}" />
        </div>

        <button type="submit" class="btn btn-warning">Sửa</button>
        <button type="reset" class="btn btn-default">Làm mới</button>
    <form>
</div>
@endsection