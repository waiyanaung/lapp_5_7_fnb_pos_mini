<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            $users = DB::select("SELECT count(id) as userCount FROM core_users WHERE deleted_at IS  NULL");
            $user_count = 0;
            if (isset($users) && count($users) > 0) {
                $user_count = $users[0]->userCount;
            }

            $items = DB::select("SELECT count(id) as tempCount FROM items WHERE deleted_at IS  NULL");
            $item_count = 0;
            if (isset($items) && count($items) > 0) {
                $item_count = $items[0]->tempCount;
            }

            $categories = DB::select("SELECT count(id) as tempCount FROM categories WHERE deleted_at IS  NULL");
            $category_count = 0;
            if (isset($categories) && count($categories) > 0) {
                $category_count = $categories[0]->tempCount;
            }

            $brands = DB::select("SELECT count(id) as tempCount FROM brands WHERE deleted_at IS  NULL");
            $brand_count = 0;
            if (isset($brands) && count($brands) > 0) {
                $brand_count = $brands[0]->tempCount;
            }

            return view('core.dashboard.dashboard')
                ->with('userCount', $user_count)
                ->with('itemCount', $item_count)
                ->with('categoryCount', $category_count)
                ->with('brandCount', $brand_count);
        }
        return redirect('/backend_app/login');
    }
}
