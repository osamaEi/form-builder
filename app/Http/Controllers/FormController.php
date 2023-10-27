<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use App\Models\job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    
   
    public function saveFormData(Request $request) {

    $formData = $request->input('form_data'); // Assuming 'form_data' is the field name
    
    // Store the form data in the database
    FormData::create([
        'data' => json_encode($formData),
    ]);

   return redirect()->back();
}

public function getFormData()
{
    // Retrieve the data from the database
    $formDataRecords = FormData::all(); // Replace 'YourModel' with the actual model name

    // Initialize an array to store the parsed form data
    $forms = [];

    // Loop through each database record and parse the JSON data
    foreach ($formDataRecords as $record) {
        $formData = json_decode($record->data, true);
        $forms[] = $formData;
    }

    // Pass the parsed form data to the view
    return view('index', compact('forms'));
}



public function storeDynamicFormData(Request $request)
{
    $formData = $request->all();

    foreach ($formData as $fieldData) {
        $field = json_decode($fieldData, true);

        if ($field['type'] == 'number') {
            // Handle number input
            $fieldName = $field['name'];
            $fieldValue = $request->input($fieldName);

            // You may add validation rules for the number field here

            Job::create([
                $fieldName => $fieldValue,
            ]);
        } elseif ($field['type'] == 'text') {
            // Handle text input
            $fieldName = $field['name'];
            $fieldValue = $request->input($fieldName);

            // You may add validation rules for the text field here

            Job::create([
                $fieldName => $fieldValue,
            ]);
        }
        // Add more conditions to handle other field types (date, button, header, etc.) as needed
    }

    // Redirect to a success page or any other action you need
    return redirect()->route('success')->with('success', 'Form data saved successfully');
}




}
