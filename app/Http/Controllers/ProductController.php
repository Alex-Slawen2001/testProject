<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\PropertyValue;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public final function lazyLoad(Request $request) {
        $query = Product::query();
        if ($request->filled('properties')) {
            foreach($request->input('properties') as $prop=>$values) {
                $query->whereHas('propertyValues',function($q) use ($prop,$values){
                    $q->whereHas('property',function($q2) use ($prop) {
                       $q2->where('name',$prop);
                    });
                })->whereIn('value ',$values) ;
            }
        }
    }
    public function index(Request $request)
    {
        $query = Product::with(['propertyValues.property']);
        if ($request->filled('properties')) {
            foreach ($request->input('properties') as $property => $values) {
                $query->whereHas('propertyValues', function ($q) use ($property, $values) {
                    $q->whereHas('property', function ($q2) use ($property) {
                        $q2->where('name', $property);
                    })->whereIn('value', $values);
                });
            }
        }
        if($request->filled('min_price')) {
            $query->where('price','>=',$request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price','<=',$request->input('max_price'));
        }

        $products = $query->paginate(40);
        return response()->json($products);
    }
    public function store(Request $request)
    {
        // Проверка входящих данных
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'property_value_ids' => 'array',
        ]);
        $product = Product::create($data);
        if(isset($data['property_value_ids'])) {
            $product->propertyValues()->attach($data['property_value_ids']);
        }
        return response()->json($product->load('propertyValues.property'), 201);
    }
    public function show($id)
    {
        $product = Product::with(['propertyValues.property'])->findOrFail($id);
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'quantity' => 'sometimes|integer',
            'property_value_ids' => 'array',
        ]);
        $product = Product::findOrFail($id);
        $product->update($data);
        if (array_key_exists('property_value_ids', $data)) {
            $product->propertyValues()->sync($data['property_value_ids']);
        }
        return response()->json($product->load('propertyValues.property'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->propertyValues()->detach();
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
