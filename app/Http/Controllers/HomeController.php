<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Offer;
use App\Category;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

      $offers = Offer::where('id', '>', 0)->with('product')->orderBy('sales', 'desc')->limit(20)->get()->toArray();

        if($request->category == null){
            $products = Product::where('id', '>', 0)->paginate(9);
            $productsAr = Product::where('id', '>', 0)->paginate(9)->toArray();
        }else{
            $products = Category::where('alias', $request->category)->first()->products()->paginate(9);
            $productsAr = Category::where('alias', $request->category)->first()->products()->paginate(9)->toArray();
        }

        if($request->category == null){
            $categories = Category::where('parent', null)->get()->toArray();
            $category = null;
        }else{

            $parentAr = Category::where('alias', $request->category)->first()->toArray();
            $category = Category::where('alias', $request->category)->first()->parent()->get()->toArray();
            if(empty($category)){
            $category = null;
            }
            $categories = Category::where('parent', $parentAr['external_id'])->get()->toArray();
        }

        return view('home', ['items'=>$offers, 'categories' => $categories, 'products' =>  $products, 'productsar' => $productsAr, 'actcategory' => $category]);
    }

    public function detail(Request $request){
    $data = [];

    $data['product'] = Product::find($request->id)->toArray();

     return view('detail', $data);
    }

     public function search(Request $request){
     $req = $request->all();
        if(!isset($request['query'])){$request['query'] = '';}
       $itemsAr = Product::search($request['query'])->paginate(9)->toArray();
       $items = Product::search($request['query'])->paginate(9);

return view('search', ['items' => $items, 'itemsar' => $itemsAr]);
     }

}
