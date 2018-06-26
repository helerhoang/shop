@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản Lý Người dùng
                            <small>{{$user->full_name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px"> 
                            @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}} <br>
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('thanhcong1'))
                    <div class="alert alert-success">{{Session::get('thanhcong1')}}                      
                    </div>
                    @endif
                        <form action="admin/user/suaus/{{$user->id}}" method="post" enctype="multipart/form-data">
                        <input class="hidden" name="_token" value="{{csrf_token()}}"/>  
                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input class="form-control" name="full_name" placeholder="Nhập Họ và tên đầy đủ" value="{{$user->full_name}}" />
                            </div>
                           <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập email" value="{{$user->email}}" readonly="" />
                            </div>
                             <div class="form-group">
                                <label>Nhập mật khẩu</label>
                                <input type="checkbox" id="chagepassword" name="chagename">
                                <input type="password" class="form-control password" name="password" placeholder="Nhập mật khẩu"  disabled="" />
                            </div>
                             <div class="form-group password">
                                <label>Nhập lại mật Khẩu</label>
                                <input type="password" class="form-control password" name="passwordagain" placeholder="Nhập lại mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                            <label>Số Điện Thoại</label>
                            <input type="text" name="phone" class="form-control" placeholder="Nhập Số điện Thoại" value="{{$user->phone}}">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address" placeholder="Nhập địa Chỉ" value="{{$user->address}}" />
                            </div>
                            <div class="form-group">
                                <label>Quyền Người dùng</label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="1" 
                                    @if($user->phanquyen==1)
                                    {{"checked"}}
                                    @endif
                                     type="radio">Admin 
                                </label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="0" 
                                      @if($user->phanquyen==0)
                                    {{"checked"}}
                                    @endif 
                                    type="radio">Thường
                                </label>
                            </div>
            
                    <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="reset" class="btn btn-default">làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection
        @section('script')
<script>
$(document).ready(function(){
$("#chagepassword").change(function(){
    if($(this).is(":checked")){

        $(".password").removeAttr('disabled');
    }
    else
    {
        $(".password").attr('disabled','');

    }
});

});
 </script>
        @endsection