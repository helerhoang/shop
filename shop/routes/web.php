<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});
Route::get('index',['as'=>'trangchu','uses'=>'pagecontroller@getIndex']);
Route::get('loai-san-pham/{type}',['as'=>'loaisanpham','uses'=>'pagecontroller@getloaisp']);
Route::get('chi-tiet-san-pham/{id}',['as'=>'chitietsanpham','uses'=>'pagecontroller@getchitietsp']);
Route::get('lien-he',['as'=>'lienhe','uses'=>'pagecontroller@getlienhe']);
Route::get('gioi-thieu',['as'=>'gioithieu','uses'=>'pagecontroller@getgioithieu']);

Route::get('themcot',function(){
	Schema::table('slide', function($table)
{
 		 $table->timestamps();
});
});
Route::get('add-to-cart/{id}',[
'as'=>'themgiohang','uses'=>'pagecontroller@getAddtoCart'
	]);
Route::get('del-cart/{id}',[
'as'=>'xoagiohang','uses'=>'pagecontroller@getDelItemCart'
	]);
Route::get('dat-hang',['as'=>'dathang','uses'=>'pagecontroller@getCheckout']);
Route::post('dat-hang',['as'=>'dathang','uses'=>'pagecontroller@postCheckout']);
//Route::get('dat-hanga',['as'=>'dathanga','uses'=>'pagecontroller@postCheckout']);
Route::get('dang-nhap',['as'=>'dangnhap','uses'=>'pagecontroller@getdangnhap']);
Route::post('dang-nhap',['as'=>'dangnhap','uses'=>'pagecontroller@postdangnhap']);
Route::get('dang-ki',['as'=>'dangki','uses'=>'pagecontroller@getdangki']);
Route::post('dang-ki',['as'=>'dangki','uses'=>'pagecontroller@postdangki']);
Route::get('dang-xuat',['as'=>'dangxuat','uses'=>'pagecontroller@getdangxuat']);
Route::get('nguoi-dung',['as'=>'nguoidung','uses'=>'pagecontroller@getnguoidung']);
Route::post('nguoi-dung',['as'=>'nguoidung','uses'=>'pagecontroller@postnguoidung']);
Route::get('tim-kiem',['as'=>'timkiems','uses'=>'pagecontroller@gettimkiem']);

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'theloai'],function(){

		Route::get('danhsach','pagecontroller@getdanhsach');

		Route::get('sua/{id}','pagecontroller@getsua');
		Route::post('sua/{id}','pagecontroller@postsua');
		
		Route::get('them','pagecontroller@getthem');
		Route::post('them','pagecontroller@postthem');
		
		Route::get('xoa/{id}','pagecontroller@getxoa');
	});
});
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'sanpham'],function(){

		Route::get('danhsachsp','pagecontroller@getdanhsachsp');

		Route::get('suasp/{id}','pagecontroller@getsuasp');
		Route::post('suasp/{id}','pagecontroller@postsuasp');
		
		Route::get('themsp','pagecontroller@getthemsp');
		Route::post('themsp','pagecontroller@postthemsp');
		
		Route::get('xoasp/{id}','pagecontroller@getxoasp');
	});
		});
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'slide'],function(){

		Route::get('danhsach','slidecontroller@getdanhsach');

		Route::get('sua/{id}','slidecontroller@getsua');
		Route::post('sua/{id}','slidecontroller@postsua');
		
		Route::get('them','slidecontroller@getthem');
		Route::post('them','slidecontroller@postthem');
		
		Route::get('xoa/{id}','slidecontroller@getxoa');
	});
		});
Route::get('admin/dangnhap','usercontroller@getdangnhapadmin');	
Route::post('admin/dangnhap','usercontroller@postdangnhapadmin');
Route::get('admin/logout','usercontroller@getdangxuatAdim');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'user'],function(){

		Route::get('danhsachus','usercontroller@getdanhsachus');

		Route::get('suaus/{id}','usercontroller@getsuaus');
		Route::post('suaus/{id}','usercontroller@postsuaus');
		
		Route::get('themus','usercontroller@getthemus');
		Route::post('themus','usercontroller@postthemus');
		
		Route::get('xoaus/{id}','usercontroller@getxoaus');
	});
		});
		