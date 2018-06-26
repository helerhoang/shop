@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại sản phẩm
                            <small>Thêm</small>
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
                    @if(Session::has('baocao'))
                    <div class="alert alert-success">{{Session::get('baocao')}}                      
                    </div>
                    @endif
                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}}
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('loi'))
                    <div class="alert alert-success">{{Session::get('loi')}}                      
                    </div>
                    @endif
                        <form action="admin/theloai/them" method="post" enctype="multipart/form-data">
                        <input class="hidden" name="_token" value="{{csrf_token()}}"/>  
                     
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Nhập tên thể loại sản phẩm" />
                            </div>
                          
                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" /  >
                            </div>
                             <input class="hidden" name="_token" value="{{csrf_token()}}"/>
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