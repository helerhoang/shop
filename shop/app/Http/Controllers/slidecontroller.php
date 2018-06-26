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
use delete;
use Hash;
use Auth;
class slidecontroller extends Controller
{
public function getdanhsach()
{
	$slide=Slide::all();
	return view('admin.slide.danhsach',['slide'=>$slide]);
}
public function getthem(){
	return view('admin.slide.them');
}
public function postthem(Request $rq){
	$slide=new Slide;
	if($rq->has('link'))
		$slide->link=$rq->link;
	 if($rq->hasFile('image'))
        {
            $file = $rq->file('image');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi != 'png' && $duoi != 'JPG' && $duoi != 'PNG'&& $duoi != 'JPEG'&& $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('caoloi','bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name= $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("source/image/slide".$image))
            {
                $image=str_random(4)."_".$name;
            }
            $file->move("source/image/slide",$image);
            $slide->image=$image;
        }
        else {

            $slide->image= "";
        }
       $slide->save();
        return redirect('admin/slide/them')->with('caocao','Thêm Slide Thành Công');
}
public function getsua($id){
	$slide= Slide::find($id);
	return view('admin.slide.sua',['slide'=>$slide]);

}
public function postsua(Request $rq,$id ){
	$slide=Slide::find($id);
	if($rq->has('link'))
		$slide->link=$rq->link;
	 if($rq->hasFile('image'))
        {
            $file = $rq->file('image');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi != 'png' && $duoi != 'JPG' && $duoi != 'PNG'&& $duoi != 'JPEG'&& $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('caoloi','bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name= $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("source/image/slide".$image))
            {
                $image=str_random(4)."_".$name;
            }
            $file->move("source/image/slide",$image);
            unlink("source/image/slide/".$slide->image);
            $slide->image=$image;
        }
       $slide->save();
		return redirect('admin/slide/sua/'.$id)->with('caocao','Sữa Thành Công');
}
public function getxoa($id){
	$slide=Slide::find($id);
	$slide->delete();
return redirect('admin/slide/danhsach')->with('caocao1','Xóa thành Công');
}
}