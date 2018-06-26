@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">sản phẩm
                            <small>{{$product->name}}</small>
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
                    @if(Session::has('thongdit'))
                    <div class="alert alert-success">{{Session::get('thongdit')}}                      
                    </div>
                    @endif
                    @if(Session::has('loiphai'))
                    <div class="alert alert-success">{{Session::get('loiphai')}}                      
                    </div>
                    @endif
                        <form action="admin/sanpham/suasp/{{$product->id}}" method="post" enctype="multipart/form-data">
                        <input class="hidden" name="_token" value="{{csrf_token()}}"/>  
                        <div class="form-group">
                                <label>Thể loại Sản Phẩm</label>
                                 <select class="form-control" name="theloai">
                                    @foreach($producttype as $pst)
                                    <option 
                                    @if($product->id_type == $pst->id)
                                    {{"selected"}}
                                    @endif
                                    value="{{$pst->id}}">{{$pst->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập tên thể loại sản phẩm" value="{{$product->name}}" />
                            </div>
                          
                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="description">{{$product->description}}</textarea>
                            </div>
                             <div class="form-group">
                                <label>Giá gốc</label>
                                <input type="number" name="unit_price" min="1000" step="1000" placeholder="nhập giá gốc sản phẩm " value="{{$product->unit_price}}" />
                            </div>
                             <div class="form-group">
                                <label>Giá Khuyến mãi</label>
                                <input type="number" name="promotion_price" step="1000" placeholder="nhập giá sản phâm khuyến mãi " value="{{$product->promotion_price}}" />
                            </div>
                            <div class="form-group">
                             <p>
                                    <img width="300px" src="source/image/product/{{$product->image}}" alt="200px">
                                </p>
                                <label>Hình sản phẩm</label>
                                <input type="file" name="image" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Đơn vị tính </label>
                                <label class="radio-inline">
                                    <input name="unit" value="cái" 
                                    @if($product->unit == "cái")
                                    {{"checked"}}
                                    @endif
                                     type="radio">Cái 
                                </label>
                                <label class="radio-inline">
                                    <input name="unit" value="hộp"
                                     @if($product->unit == "hộp")
                                    {{"checked"}}
                                    @endif
                                     type="radio">Hộp
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm mới </label>
                                <label class="radio-inline">
                                    <input name="new" value="1" @if($product->new == 1)
                                    {{"checked"}}
                                    @endif type="radio">Sản phẩm mới 
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="0" 
                                    @if($product->new == 0)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Sản phẩm củ
                                </label>
                            </div>
                             <input class="hidden" name="_token" value="{{csrf_token()}}"/>
                            <button type="submit" class="btn btn-primary">Sữa</button>
                            <button type="reset" class="btn btn-default">làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection