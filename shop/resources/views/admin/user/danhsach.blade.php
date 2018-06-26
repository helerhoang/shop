 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản Lý người dùng
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(Session::has('thongbao2'))
                    <div class="alert alert-success">{{Session::get('thongbao2')}}                      
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Họ Và Tên</th>
                                <th>Email</th>
                                <th>Mật Khẩu</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa Chỉ</th>
                                <th>Phân Quyền</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $er)
                            <tr class="even gradeC" align="center">
                                <td>{{$er->id}}</td>
                                <td>{{$er->full_name}}</td>
                                <td>{{$er->email}}</td>
                                <td>{{$er->password}}</td>
                                <td>{{$er->phone}}</td>
                                <td>{{$er->address}}</td>
                                <td>
                                @if($er->phanquyen==1)
                                {{"Admin"}}
                                @else
                                {{"Thường"}}
                                @endif                           
                               <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoaus/{{$er->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/suaus/{{$er->id}}">Edit</a></td>
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