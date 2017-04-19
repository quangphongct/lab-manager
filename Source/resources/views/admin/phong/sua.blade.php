@extends('admin.layout.index')
@section('title')
Phòng - Sửa
@endsection
@section('content')
<!-- Page Content -->
<div class="col-md-12" style="padding-top: 10px">
    <a style="width: 20%" class="btn btn-primary" href="admin/phong/danhsach"><span class="glyphicon glyphicon-list-alt"></span>   DANH SÁCH</a>
    <a style="width: 20%" class="btn btn-success" href="admin/phong/them"><span class="glyphicon glyphicon-plus"></span>  THÊM</a>
</div>
<div class="col-md-8" style="padding-top: 10px">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">SỬA PHÒNG {{$phong->TenPhong}}</div>
            <div class="panel-body">
                <form action="admin/phong/sua/{{$phong->id}}" method="POST">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="col-md-6">
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
                    </div>
                    <div class="col-md-6">
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
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có muốn cập nhật {{$phong->TenPhong}}  không?');">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                <form>
            </div>
        </div>
    </div>
    <div class="col-md-4" style="padding-top: 10px">
        <form >
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <tr>
                    <th>STT</th>
                    <th>Tên phần mềm</th>
                    <th>Phiên bản</th>
                    <th>Xóa</th>
                </tr>
                <?php $i=0; ?>
                @foreach($phong_phanmem as $pm)
                <?php $i++; ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$pm->TenPM}}</td>
                    <td>{{$pm->PhienBan}}</td>
                    <td><a href="admin/phong/chitiet/xoaPM/{{$pm->id}}/{{$pm->idPhong}}">Xóa</a></td>
                </tr>
                @endforeach
            </table>
        </form>
    </div>
@endsection