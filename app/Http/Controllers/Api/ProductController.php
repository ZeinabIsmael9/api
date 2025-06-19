<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'products_' . md5(json_encode($request->all()));
        $products = Cache::remember($cacheKey, 600, function () use ($request) {
            return $this->filter($request);
        });
        return response()->json($products);
    }

    public function export(Request $request)
    {
        $products = $this->filter($request);
        $pdf = Pdf::loadView('pdf.products', compact('products'));
        return $pdf->download('filtered_products.pdf');
    }

    public function filter($request)
    {
        $query = Product::query();
        if ($request->has('sort_by')) {
            $sort = explode(',', $request->sort_by);
            $column = $sort[0] ?? 'created_at';
            $direction = $sort[1] ?? 'asc';
            if (in_array($column, ['price', 'created_at']) && in_array($direction, ['asc', 'desc'])) {
                $query->orderBy($column, $direction);
            }
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('in_stock')) {
            $query->where('in_stock', $request->in_stock);
        }

        return $query->get();
    }
}
