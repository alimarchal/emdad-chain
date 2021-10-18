<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\Category;
use App\Models\EOrderItems;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        return view('category.category.index', compact('parentCategories'));
    }

    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->where('is_active',1)->orderBy('name', 'asc')->get();
        return view('category.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $created_category = Category::create($request->all());
        if (auth()->user()->rtl == 0)
        {
            session()->flash('message', $created_category->name  . ' category successfully created.');
        }
        else{
            session()->flash('message', $created_category->name_ar  . ' تم إنشاء الفئة بنجاح.');
        }

        return redirect()->route('category.create');
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        return view('category.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {

        if (empty($request->parent_id)) {

            if ($request->parent_id == null) {
                $request->merge(['parent_id' => $category->parent_id]);
            }

            // dd($request->all());
            $updated = $category->update($request->all());
            session()->flash('message', __('portal.Category updated successfully.'));
            return redirect()->route('showAllCategory');
        } else {
            $updated = $category->update($request->all());
            session()->flash('message', __('portal.Category updated successfully.'));
            return redirect()->route('showAllCategory');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message', __('portal.Category successfully deleted.'));
        return redirect('category/show');
    }

    public function showAllCategories()
    {
        $category = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();;
        return view('category.show', compact('category'));
    }

    public function parentCategories()
    {
        $parentCategories = Category::where('parent_id', 0)->where('is_active',1)->orderBy('name', 'asc')->get();
        $businessPackage = BusinessPackage::where('user_id', auth()->id())->first();

        return view('category.show.categories', compact('parentCategories', 'businessPackage'));
    }

    public function subCategories()
    {
        $category = Category::where('parent_id', 0)->where('is_active',1)->orderBy('name', 'asc')->get();;
        return view('category.show.subCategories', compact('category'));
    }

    //Businesses registered in categories record related to SupplyChainManager And SuperAdmin
    public function categoryRelatedBusiness($id)
    {
        $categories = BusinessCategory::with('business')->where('category_number', decrypt($id))->get();
        return view('category.categoryRelatedbusiness', compact('categories'));
    }

    //Active RFQs record related to SupplyChainManager And SuperAdmin
    public function activeRFQs($id)
    {
        $activeRFQs = EOrderItems::where(['item_code' => decrypt($id), 'bypass' => 0])->where('quotation_time', '>=', Carbon::now()->toDateTimeString())->get();

        return view('category.active_rfq', compact('activeRFQs'));
    }

    //Active RFQ details view related to SupplyChainManager And SuperAdmin
    public function activeRFQView($id)
    {
        $activeRFQs = EOrderItems::where('id', $id)->get();

        return view('category.active_rfq_view', compact('activeRFQs'));
    }
}
