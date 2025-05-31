<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Http\Request;
class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('values')->get();
        return response()->json($properties);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:properties,name'
        ]);
        $property = Property::create($data);
        return response()->json($property, 201);
    }
    public function show($id)
    {
        $property = Property::with('values')->findOrFail($id);
        return response()->json($property);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate(['name' => 'required|string|unique:properties,name,'.$id]);
        $property = Property::findOrFail($id);
        $property->update($data);
        return response()->json($property);
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return response()->json(['message' => 'Property deleted']);
    }
}
