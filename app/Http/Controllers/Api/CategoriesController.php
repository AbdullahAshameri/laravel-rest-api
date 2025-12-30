<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
    
class CategoriesController extends Controller
{
    public function index () {

        $categories = Category::select('id', 'name_ar', 'name_en')->get();
        return response()->json($categories);
    }
}
