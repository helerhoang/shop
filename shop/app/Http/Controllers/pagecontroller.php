<?php 
namespace App\Http\Controllers;
Use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use Illuminate\Http\Request;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
class pagecontroller extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	// return view('page.trangchu',compact('slide'));
    	$new_product = Product::where('new',1)->paginate(4);
    	$sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(8);
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }
    public function getloaisp($type){
     $sp_theoloai =Product::where('id_type',$type)->get();
     $sp_khac=Product::where('id_type','<>',$type)->paginate(3);
   	 $sp_loai=ProductType::all();
     $loai_sp=ProductType::where('id',$type)->first();
    return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','sp_loai','loai_sp'));
    
    }
     public function getchitietsp(Request $req){
        $sanpham=Product::where('id',$req->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(6);
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }
    public function getlienhe(){
    	return view('page.lienhe');
    }
    public function getgioithieu(){
    	return view('page.gioithieu');
    }
    public function getAddtoCart(Request $req ,$id){
        $product= Product::find($id);
        $oldCart= Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getDelItemCart($id){

        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
        Session::put('cart',$cart);    
        }
        else{
        Session::forget('cart');    
        }
        
        return redirect()->back();
    }
    public function getCheckout(){

        return view('page.dat_hang');
    }
    public function postCheckout(Request $req){
        $cart = Session::get('cart');
  
        $customer = new Customer;
        $customer ->name= $req->name;
        $customer ->gender = $req->gender;
        $customer ->email=$req->email;
        $customer  ->address=$req->address;
        $customer  ->phone_number=$req->phone;
        $customer  ->note=$req->notes;
        $customer ->save();

        $bill= new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total= $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note= $req->notes;
        $bill->save();
        foreach($cart->items as $key =>$value){
        $bill_detail =  new BillDetail;
        $bill_detail->id_bill= $bill->id;
        $bill_detail->id_product= $key;
        $bill_detail->quantity= $value['qty'];
        $bill_detail->unit_price= ($value['price']/$value['qty']);
        $bill_detail->save();
        }
          Session::forget('cart');
          return redirect()->back()->with('thongbao','đặt hàng thành công');
    }
    public function getdangnhap(){
        return view('page.dangnhap');
    }
    public function getdangki(){
        return view('page.dangki');
    }
     public function postdangki(Request $req){
        $this->validate($req,
            [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:20',
            'fullname'=>'required',
            're_password'=>'required|same:password'
            ],
            [
            'email.required'=>'vui lòng nhập email',
            'email.email'=>'không đúng định dạng email',
            'email.unique'=>'vui lòng nhập mật khẩu',
            're_password.same'=>'mật khẩu không giống nhau',
            'password.min'=>'mật khẩu ít nhất 5 kí tự'         
            ]);
        $user= new User();
        $user->full_name= $req->fullname;
        $user->email=$req->email;
        $user->password= Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','tạo tài khoản thành công');
    }
    public function postdangnhap(Request $req){
        $this->validate($req,
            [
            'email'=>'required|email',
            'password'=>'required|min:5|max:20'
            ],
            [
            'email.required'=>'vui lòng nhập email',
            'email.email'=>'email không đúng định dạng',
            'password.required'=>'vui lòng nhập mật khẩu',
            'password.min'=>'mật khẩu ít nhất là 5 kí tự',
            'password.max'=>'mật khẩu ít nhất là 20 kí tự',
            ]);
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){

            return redirect('index');
        }
        else
        {
            return redirect()->back()->with(['flag'=>'danger','message'=>'đăng nhập không thành công']);
        }
    }
    public function getnguoidung(){
        $user=Auth::user();
        return view('page.nguoidung',['nguoidung'=>$user]);
    }
    public function postnguoidung(Request $rq ){
$this->validate($rq,[
    'full_name'=>'required|min:3',
    'email'=>'required|email|unique:users,email',
    'password'=>'required|min:3|max:32',
    'passwordagain'=>'required|same:password'
    ],[
    'full_name.required'=>'bạn chưa nhập tên người dùng',
    'full_name.min'=>'tên người dùng phải có ít nhất 3 kí tự',
    'email.required'=>'Bạn chưa nhập tên email',
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
        
        $user->save();
        return redirect('admin/user/themus')->with('thanhcong1','Tạo tài khoản thành công');

    }
    public function getdangxuat(){

        Auth::logout();
        return redirect()->route('trangchu');
    }
    public function gettimkiem(Request $rq){
            $product=Product::where('name','like','%'.$rq->key.'%')
            ->orwhere('unit_price',$rq->key)
            ->get();
            return view('page.seach',compact('product'));
    }
    public function getdanhsach(){
        $producttype = ProductType::all();
        return view('admin.theloai.danhsach',['producttype'=>$producttype]);
    
    }
     public function getthem(){
        return view('admin.theloai.them');
    }
    public function postthem(Request $rq){
        $this->validate($rq,
[
    'name'=>'required|min:3|max:100',
    'description'=>'required'
],
[
    'name.required'=>'Bạn chưa nhập tên thể loại',
    'name.min'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'name.max'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'description.required'=>'bạn chưa nhập description'
            ]);
        $producttype = new ProductType;
        $producttype->name=$rq->name;
        $producttype->description=$rq->description;
        if($rq->hasFile('image'))
        {
            $file = $rq->file('image');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi != 'png' && $duoi != 'JPG' && $duoi != 'PNG'&& $duoi != 'JPEG'&& $duoi != 'jpeg')
            {
                return redirect('admin/theloai/them')->with('loi','bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name= $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("source/image/product".$image))
            {
                $image=str_random(4)."_".$name;
            }
            $file->move("source/image/product",$image);
            $producttype->image=$image;
        }
        else {

            $producttype->image= "";
        }
       $producttype->save();
        return redirect('admin/theloai/them')->with('baocao','thêm thành công');
    } 
    public function getsua($id){
        $producttype= ProductType::find($id);
        return view('admin.theloai.sua',['producttype'=>$producttype]);
    }
    public function postsua(Request $rq,$id){
        $producttype = ProductType::find($id);
         $this->validate($rq,[
    'name'=>'required|min:3|max:100',
    'description'=>'required'
],
[
    'name.required'=>'Bạn chưa nhập tên thể loại',
    'name.min'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'name.max'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'description.required'=>'bạn chưa nhập description'
            ]);
        $producttype->name=$rq->name;
        $producttype->description=$rq->description;
        if($rq->hasFile('image'))
        {
            $file = $rq->file('image');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi != 'png' && $duoi != 'JPG' && $duoi != 'PNG'&& $duoi != 'JPEG'&& $duoi != 'jpeg')
            {
                return redirect('admin/theloai/them')->with('loi','bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name= $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("source/image/product".$image))
            {
                $image=str_random(4)."_".$name;
            }
            $file->move("source/image/product",$image);
            unlink("source/image/product/".$producttype->image);
            $producttype->image=$image;
        }
       $producttype->save();
       return redirect('admin/theloai/sua/'.$id)->with('baocao','sữa thành công');
    }
    public function getxoa($id){
        $producttype=ProductType::find($id);
        $producttype->delete();
        return redirect('admin/theloai/danhsach')->with('baocao','Xóa Thành công');
    }
    public function getdanhsachsp(){

        $sanpham=Product::orderBy('id','DESC')->get();
        return view('admin.sanpham.danhsach',['sanpham'=>$sanpham]);
    }
    public function getthemsp(){
        $producttype=ProductType::all(); 
        return view("admin/sanpham/them",['producttype'=>$producttype]);
    }
    public function postthemsp(Request $rq){
        $this->validate($rq,
[
    'theloai'=>'required',
    'name'=>'required|min:3|max:100',
    'description'=>'required',
    'unit_price'=>'required'
],
[
    'name.required'=>'Bạn chưa nhập tên thể loại',
    'name.min'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'name.max'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'description.required'=>'bạn chưa nhập description',
    'unit_price.required'=>'bạn chưa nhập giá sản phẩm',
    'theloai.required'=> 'bạn chọn loại sản phẩm'
            ]);
        $product= new Product;
        $product->id_type=$rq->theloai;
        $product->name= $rq->name;
        $product->description=$rq->description;
        $product->unit_price=$rq->unit_price;
        $product->promotion_price=$rq->promotion_price;
        $product->unit=$rq->unit;
        $product->new=$rq->new;

        if($rq->hasFile('image'))
        {
            $file = $rq->file('image');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi != 'png' && $duoi != 'JPG' && $duoi != 'PNG'&& $duoi != 'JPEG'&& $duoi != 'jpeg')
            {
                return redirect('admin/sanpham/themsp')->with('loiloi','bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name= $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("source/image/product".$image))
            {
                $image=str_random(4)."_".$name;
            }
            $file->move("source/image/product",$image);
            $product->image=$image;
        }
        else {

            $product->image= "";
        }
       $product->save();
        return redirect('admin/sanpham/themsp')->with('baobao','Thêm Sản phẩm thành công');
    }
    public function getsuasp($id){
        $producttype=ProductType::all();
        $product= Product::find($id);
        return view('admin.sanpham.sua',['product'=>$product,'producttype'=>$producttype]);
       
    }
    public function postsuasp(Request $rq,$id){
    $product = Product::find($id);
         $this->validate($rq,[
    'theloai'=>'required',
    'name'=>'required|min:3|max:100',
    'description'=>'required',
    'unit_price'=>'required'
],
[
    'name.required'=>'Bạn chưa nhập tên thể loại',
    'name.min'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'name.max'=>'Tên thể loại sản phẩm phải có đọ dài lớn hơn 3 và nhỏ hơn 100 kí tự',
    'description.required'=>'bạn chưa nhập description',
    'unit_price.required'=>'bạn chưa nhập giá sản phẩm',
    'theloai.required'=> 'bạn chọn loại sản phẩm'
            ]);
          $product->id_type=$rq->theloai;
        $product->name= $rq->name;
        $product->description=$rq->description;
        $product->unit_price=$rq->unit_price;
        $product->promotion_price=$rq->promotion_price;
        $product->unit=$rq->unit;
        $product->new=$rq->new;
        if($rq->hasFile('image'))
        {
            $file = $rq->file('image');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi != 'png' && $duoi != 'JPG' && $duoi != 'PNG'&& $duoi != 'JPEG'&& $duoi != 'jpeg')
            {
                return redirect('admin/sanpham/themsp')->with('loiphai','bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name= $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("source/image/product".$image))
            {
                $image=str_random(4)."_".$name;
            }
            $file->move("source/image/product",$image);
            
            $product->image=$image;
        }
       $product->save();
       return redirect('admin/sanpham/suasp/'.$id)->with('thongdit','sữa thành công');
    }
    public function getxoasp($id){
        $product=Product::find($id);
        $product->delete();
     return redirect('admin/sanpham/danhsachsp')->with('baocao','Xóa Thành công');

    }
} 