 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách
                            <small>sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(Session::has('baocao'))
                    <div class="alert alert-success">{{Session::get('baocao')}}                      
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Mã loại sản phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá gốc</th>
                                <th>Giá Khuyến Mãi</th>
                                <th>Hình ảnh</th>
                                <th>Đơn vị tính</th>
                                <th>Sản phẩm mới</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sanpham as $sp)
                            <tr class="odd gradeX" align="center">
                                <td>{{$sp->id}}</td>
                                <td>{{$sp->id_type}}</td>
                                <td>{{$sp->name}}</td>
                                <td>{{$sp->description}}</td>
                                <td>{{$sp->unit_price}}</td>
                                <td>{{$sp->promotion_price}}</td>
                                 <td><img src="source/image/product/{{$sp->image}}" height="100 px" alt="100 px"></td>
                                <td>{{$sp->unit}}</td>
                                <td>
                                    @if($sp->new==0)
                                    {{"không"}}
                                    @else
                                    {{"có"}}
                                    @endif
                                </td>
                              
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/sanpham/xoasp/{{$sp->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sanpham/suasp/{{$sp->id}}">Edit</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection