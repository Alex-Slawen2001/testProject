<?php

namespace App\Http\Controllers;
use App\Models\PropertyValue;
use Illuminate\Http\Request;
class PropertyValueController extends Controller
{
    public function index()
    {
        $values = PropertyValue::with('property')->get();
        return response()->json($values);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'value' => 'required|string'
        ]);
        $propertyValue = PropertyValue::create($data);
        return response()->json($propertyValue, 201);
    }
    public function show($id)
    {
        $value = PropertyValue::with('property')->findOrFail($id);
        return response()->json($value);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'property_id' => 'sometimes|exists:properties,id',
            'value' => 'required|string'
        ]);
        $propertyValue = PropertyValue::findOrFail($id);
        $propertyValue->update($data);
        return response()->json($propertyValue);
    }
    public function destroy($id)
    {
        $propertyValue = PropertyValue::findOrFail($id);
        $propertyValue->delete();
        return response()->json(['message' => 'Property value deleted']);
    }
}
