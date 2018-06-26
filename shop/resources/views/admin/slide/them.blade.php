@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                    @if(Session::has('caocao'))
                    <div class="alert alert-success">{{Session::get('caocao')}}                      
                    </div>
                    @endif
                    @if(Session::has('caoloi'))
                    <div class="alert alert-success">{{Session::get('caoloi')}}                      
                    </div>
                    @endif
                        <form action="admin/slide/them" method="post" enctype="multipart/form-data">
                        <input class="hidden" name="_token" value="{{csrf_token()}}"/>  
                            
                            <div class="form-group">
                                <label>Hình Nền</label>
                                <input type="file" name="image" class="form-control" />
                            </div>
                             <div class="form-group">
                                <label>Tên Link</label>
                                <input class="form-control" name="link" placeholder="Nhập Link" />
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