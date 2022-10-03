<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ProductListRequest;
use App\Http\Resources\API\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Get products from storage
     *
     * @param ProductListRequest $request
     * @return JsonResponse
     */
    public function index(ProductListRequest $request): JsonResponse
    {
        $category = $request->get('category');
        $priceFrom = $request->get('price_from');
        $priceTo = $request->get('price_to');

        $products = Product::query()
            ->when($request->has('category'), function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when($request->has('price_from'), function ($query) use ($priceFrom) {
                $query->where('price', '>=', $priceFrom);
            })
            ->when($request->has('price_to'), function ($query) use ($priceTo) {
                $query->where('price', '<=', $priceTo);
            })
            ->paginate($request->get('per_page', 15));

        $data = ProductResource::collection($products);

        return Response::paginate($data->resource, $data->collection, 'Products fetched successfully');
    }
}
