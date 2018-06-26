<?php

namespace App\Http\Controllers;
Use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
use delete;
use Hash;
class usercontroller extends Controller
{
public function getdanhsachus(){
	$user=User::all();
	return view('admin/user/danhsach',['user'=>$user]);
}
public function getthemus(){

	return view('admin/user/them');
}
public function postthemus(Request $rq)
{
	$this->validate($rq,[
	'full_name'=>'required|min:3',
	'email'=>'required|email|unique:users,email',
	'password'=>'required|min:3|max:32',
	'passwordagain'=>'required|same:password'
	],[
	'full_name.required'=>'bạn chưa nhập tên người dùng',
	'full_name.min'=>'tên người dùng phải có ít nhất 3 kí tự',
	'email.required'=>'Bạn Chưa nhập Email',
	'email.email'=>'bạn chưa nhập đúng định dạng',
	'email.unique'=>'Email Đã tồn tại',
	'password.required'=>'bạn chưa nhập mật khẩu',
	'password.min'=>'mật khẩu phải lớn hơn 3 kí tự',
	'password.max'=>'mật khẩu phải nhơ hơn 32 kí tự',
	'passwordagain.required'=>'Bạn chưa nhập lại mật khẩu',
	'passwordagain.same'=>'mật khẩu nhập lại chưa khớp'	
	]);
  $user= new User();
       	 $user->full_name= $rq->full_name;
        $user->email=$rq->email;
        $user->password= bcrypt($rq->password);
        $user->phone=$rq->phone;
        $user->address=$rq->address;
        $user->phanquyen=$rq->phanquyen;
        $user->save();
        return redirect('admin/user/themus')->with('thanhcong1','Tạo tài khoản thành công');

}
public function getsuaus($id){
	$user=User::find($id);
	return view('admin/user/sua',['user'=>$user]);
}
public function postsuaus(Request $rq,$id){

	$this->validate($rq,[
	'full_name'=>'required|min:3'
	],[
	'full_name.required'=>'bạn chưa nhập tên người dùng',
	'full_name.min'=>'tên người dùng phải có ít nhất 3 kí tự'
	]);
		$user=User::find($id);
       	$user->full_name= $rq->full_name;
        $user->phone=$rq->phone;
        $user->address=$rq->address;
        $user->phanquyen=$rq->phanquyen;
        if($rq->chagepassword=="on")
        {   	
	$this->validate($rq,[
	'password'=>'required|min:3|max:32',
	'passwordagain'=>'required|same:password'
	],[	
	'password.required'=>'bạn chưa nhập mật khẩu',
	'password.min'=>'mật khẩu phải lớn hơn 3 kí tự',
	'password.max'=>'mật khẩu phải nhơ hơn 32 kí tự',
	'passwordagain.required'=>'Bạn chưa nhập lại mật khẩu',
	'passwordagain.same'=>'mật khẩu nhập lại chưa khớp'	
	]);
	 $user->password= bcrypt($rq->password);
        }
        $user->save();
        return redirect('admin/user/themus')->with('thanhcong1','Sữa Tài khoản thành công');
}
public function getxoaus($id){
	$user=User::find($id);
	$user->delete();
	return redirect('admin/user/danhsachus/')->with('thongbao2','Bạn đã xóa thành công');
}
public function getdangnhapadmin(){
	return view('admin/dangnhap');
}
public function postdangnhapadmin(Request $rq){

	$this->validate($rq,[
		'email'=>'required',
		'password'=>'required|min:3|max:32'
		],[
		'email.required'=>'Bạn chưa nhập Email',
		'password.required'=>'Bạn chưa nhập password',
		'password.min'=>'Password phải lớn hơn 3 kí tự',
		'password.max'=>'Password phải nhỏ hơn 32 kí tự'
		]);
	if(Auth::attempt(['email'=>$rq->email,'password'=>$rq->password]))
	{
		return redirect('admin/theloai/danhsach');
	}
	else{
	return redirect('admin/dangnhap')->with('thongbao','Đăng nhập thất bại');	
	}
}
public function getdangxuatAdim(){
		Auth::logout();
		return redirect('admin/dangnhap');
	}
}
