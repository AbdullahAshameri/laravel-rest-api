<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\GeneralTrait;

class CategoriesController extends Controller
{
    use GeneralTrait;
    public function index () {

        $categories = Category::select('id', 'name_'.app()->getLocale())->get();
        return response()->json($categories);
    }

    public function getCategoryById (Request $request) {

        $category = Category::select('id', 'name_' . app()->getLocale())->find($request->id);
        if(!$category)
            return $this->returnError('001', 'هذا القسم غير موجود');
        return $this->returnData('category', $category);
    }
}
