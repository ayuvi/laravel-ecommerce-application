<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\AttributeContract;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    protected $attributerepository;

    public function __construct(AttributeContract $attributerepository)
    {
        $this->attributerepository = $attributerepository;
    }

    public function getValues(Request $request)
    {
        $attributeId = $request->input('id');
        $attribute = $this->attributerepository->findAttributeById($attributeId);

        $values = $attribute->values;

        return response()->json($values);
    }

    public function addValues(Request $request)
    {
        // ambil dari model masuk ke var
        $value = new AttributeValue();

        //panggil masing masing field di isi dengan inputan dari view
        $value->attribute_id = $request->input('id');
        $value->value = $request->input('value');
        $value->price = $request->input('price');
        $value->save();

        return response()->json($value);
    }

    public function updateValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('valueId'));
        $attributeValue->attribute_id = $request->input('id');
        $attributeValue->value = $request->input('value');
        $attributeValue->price = $request->input('price');
        $attributeValue->save();

        return response()->json($attributeValue);
    }

    public function deleteValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('id'));
        $attributeValue->delete();

        return response()->json(['status' => 'success', 'message' => 'Attribute value deleted successfully.']);
    }
}
