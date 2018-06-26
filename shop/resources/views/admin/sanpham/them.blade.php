@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">sản phẩm
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
                    @if(Session::has('baobao'))
                    <div class="alert alert-success">{{Session::get('baobao')}}                      
                    </div>
                    @endif
                    @if(Session::has('loiloi'))
                    <div class="alert alert-success">{{Session::get('loiloi')}}                      
                    </div>
                    @endif
                        <form action="admin/sanpham/themsp" method="post" enctype="multipart/form-data">
                        <input class="hidden" name="_token" value="{{csrf_token()}}"/>  
                        <div class="form-group">
                                <label>Thể loại Sản Phẩm</label>
                                <select class="form-control" name="theloai">
                                    @foreach($producttype as $pst)
                                    <option value="{{$pst->id}}">{{$pst->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập tên thể loại sản phẩm" />
                            </div>
                          
                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="description"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Giá gốc</label>
                                <input type="number" name="unit_price" min="1000" step="1000" placeholder="nhập giá gốc sản phẩm " />
                            </div>
                             <div class="form-group">
                                <label>Giá Khuyến mãi</label>
                                <input type="number" name="promotion_price" step="1000" placeholder="nhập giá sản phâm khuyến mãi " />
                            </div>
                            <div class="form-group">
                                <label>Hình sản phẩm</label>
                                <input type="file" name="image" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Đơn vị tính </label>
                                <label class="radio-inline">
                                    <input name="unit" value="cái" checked="" type="radio">Cái 
                                </label>
                                <label class="radio-inline">
                                    <input name="unit" value="hộp" type="radio">Hộp
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm mới </label>
                                <label class="radio-inline">
                                    <input name="new" value="1" checked="" type="radio">Sản phẩm mới 
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="0" type="radio">Sản phẩm củ
                                </label>
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