@extends('admin.layout.index')
@section('title')
Giáo viên - Danh sách
@endsection
@section('content')
<!-- Page Content -->
<div class="col-md-12 text-center" style="color: blue"><h2>DANH SÁCH GIÁO VIÊN</h2></div>
<div class="col-md-12 text-center" style="padding-top: 10px">
	<a style="width: 20%" class="btn btn-primary" href="admin/giaovien/danhsach"><span class="glyphicon glyphicon-list-alt"></span>   DANH SÁCH</a>
	<a style="width: 20%" class="btn btn-success" href="admin/giaovien/them"><span class="glyphicon glyphicon-plus"></span>  THÊM</a>
</div>
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
	    <thead>
	        <tr class="text-center">
	            <th>Mã giáo viên</th>
	            <th>Họ tên</th>
	            <th>Chức vụ</th>
	            <th>Bộ môn</th>
	            <th>Chi tiết</th>
	            <th>Delete</th>
	            <th>Edit</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@if(session('thongbao'))
	    		<div class="alert alert-success">
	    			{{session('thongbao')}}
	    		</div>
	    	@endif	
	        @foreach($giaovien as $gv)
	            <tr class="odd gradeX" align="center">
	                <td>{{$gv->MaGV}}</td>
	                <td>{{$gv->HoGV}} {{$gv->TenGV}}</td>
	                <td>
	                	@foreach($chucvu as $cv)
	                		@if($cv->id == $gv->idChucVu)
	                			{{$cv->TenCV}}
	                		@endif
	                	@endforeach
	                </td>
	                <td>
	                	@foreach($bomon as $bm)
	                		@if($bm->id == $gv->idBoMon)
	                			{{$bm->TenBM}}
	                		@endif
	                	@endforeach
	                </td>
	                <td><a href="admin/giaovien/chitiet/{{$gv->id}}">Chi tiết</a></td>
	                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/phong/xoa/{{$gv->id}}" onclick="return confirm('Bạn có muốn xóa giáo viên {{$gv->TenGV}} không?');"> Xóa</a></td>
	                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/giaovien/sua/{{$gv->id}}">Sửa</a></td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
</div>

@endsection