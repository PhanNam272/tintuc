<?php

namespace App\Http\Controllers\admin;

use App\Components\CategoryRecursive;
use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Models\brand;
use App\Models\Category;
use App\Models\product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CategoryControllers extends Controller
{
 
    public function index(){  
        $categories=Category::latest()->paginate(5);
        return view("admin.category.index",compact("categories"));
    }
    // với sự khác biệt là $this->model->where sử dụng một đối tượng model
    //  đã được khởi tạo trước đó, trong khi Model::where sử dụng tên lớp model trực tiếp.
 

    public function create(){ 
        
          $htmlOption= $this->getCategories("");
          return view("admin.category.add",compact('htmlOption') );
    }
    
    public function store(Request $request )
    {

            try {
                Category::create([
                    'name'=>$request->name
                ]);
               // Gửi thông báo thành công
            // session()->flash('success', 'Thêm danh mục thành công!');
            return back()->with('success', 'Thêm danh mục thành công!');
            } catch (\Throwable $th) {
                return back()->with('error', 'Thêm danh mục không thành công!');
            }
        
           
        
    }
    


    
    public function edit(Request $request,$id){
        
        $category=$this->category::find($id);
        
        return view("admin.category.edit",compact("category"));
    }
    public function update(Request $request,$id){
        
            $request->validate([
                "category_name"=>'required'
            ],
            ["category_name.required"=>'Không được để trống' ]

        );
        $slug = Str::of($request->input('category_name'))->slug('-');
           $category=$this->category::find($id);
           $category->update([
                'category_name' =>$request->input('category_name'),
                'category_slug' => $slug,
            ]);
            session()->flash('success', 'Cập nhật danh mục thành công!');
            return redirect()->route('category.index'); 
    }
    public function delete($id){
        
        try{  
           $foundProduct=$this->product->where("product_category_id",$id)->get();
           if($foundProduct->isNotEmpty()){
            session()->flash('error', 'Vui lòng xóa hết sản phẩm thuộc danh mục!');
            return response()->json(['code' => 500, 'message' => 'Vui lòng xóa hết sản phẩm thuộc danh mục này!']);
           }
            Category::find($id)->delete();  
            return response()->json(['code' => 200, 'message' => 'Xóa sản phẩm thành công!']); 
            } catch (\Exception $e) {
                // Log lỗi
                Log::error($e->getMessage());
                // Gửi thông báo lỗi
                return response()->json(['code' => 500, 'message' => 'Đã xảy ra lỗi khi xóa danh mục.']); 
            }
        
    }



}
