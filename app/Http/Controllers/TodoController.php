<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shoplist;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    //Shop Lists
    public  function  index(){

        $shoplists = Shoplist::get();

        return view('welcome',compact('shoplists'));

    }

    public  function  addShoptitle(Request $request){


          $shoplist = new Shoplist();
          $shoplist->title = $request->shop_title;
          $shoplist->save();

          return redirect()->back();

    }

    public  function  removeList(Request $request){
        $shoplist =Shoplist::findOrFail($request->list_id);
        $shoplist->delete();

    }

    public  function  changeListStatus(Request $request){

        $shoplist = Shoplist::find($request->list_id);
        if($request->list_status == true){
            $shoplist->status ='Liste alışverişi yapıldı' ;
        }
        if($request->list_status == 'false'){
            $shoplist->status ='Alışveriş yapılmadı' ;
        }
        $shoplist->save();


    }


    //Products

    public  function  addProductPage($id){

        //Listeye ait id ve liste adını  sessiona kaydediyoruz.Listeye ürün eklerken bu bilgileri kullanacağız..
        session()->put('list_id',$id);
        $shoptitle=Shoplist::findOrFail($id);
        session()->put('list_title',$shoptitle->title);


        $products = Product::whereListId($id)->get();
        return view('addProduct',compact('products'));
    }

    public  function  addProduct(Request $request){


        $product = new Product();
        $product->list_id = session()->get('list_id');
        $product->title = $request->product_title;
        $product->save();
        return redirect()->back();

    }

    public  function  removeProduct(Request $request){

        $product = Product::findOrFail($request->remove_id);
        $product->delete();

    }

    public  function  changeProductStatus(Request $request){

        $product = Product::find($request->product_id);
        if($request->product_status == true){
            $product->status ='Ürün alındı' ;
        }
        if($request->product_status == 'false'){
            $product->status ='Ürün alınmadı' ;
        }
        $product->save();


    }
}
