 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách
                            <small>Thể loại</small>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($producttype as $pt_tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$pt_tt->id}}</td>
                                <td>{{$pt_tt->name}}</td>
                                <td>{{$pt_tt->description}}</td>
                                <td><img src="source/image/product/{{$pt_tt->image}}" height="100 px" alt="100 px"></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/theloai/xoa/{{$pt_tt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/sua/{{$pt_tt->id}}">Edit</a></td>
                            @endforeach
                            </tr>        
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection