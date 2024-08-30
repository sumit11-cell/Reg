<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'education' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|integer',
            'profile_picture' => 'nullable|image',
            'documents.*' => 'nullable|mimes:pdf,jpg,png|max:2048'
        ]);

        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->education = $request->education;
        $student->address = $request->address;
        $student->phone_number = $request->phone_number;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures');
            $student->profile_picture = $path;
        }

        if ($request->hasFile('documents')) {
            $paths = [];
            foreach ($request->file('documents') as $document) {
                $paths[] = $document->store('documents');
            }
            $student->documents = json_encode($paths);
        }

        $student->save();

        return response()->json($student, 201);
    }

    public function show($id)
    {
        return Student::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'education' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|integer',
            'profile_picture' => 'nullable|image',
            'documents.*' => 'nullable|mimes:pdf,jpg,png|max:2048'
        ]);

        $student = Student::findOrFail($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->education = $request->education;
        $student->address = $request->address;
        $student->phone_number = $request->phone_number;

        if ($request->hasFile('profile_picture')) {
            Storage::delete($student->profile_picture);
            $path = $request->file('profile_picture')->store('profile_pictures');
            $student->profile_picture = $path;
        }

        if ($request->hasFile('documents')) {
            $existingDocuments = json_decode($student->documents, true) ?? [];
            foreach ($existingDocuments as $existingDocument) {
                Storage::delete($existingDocument);
            }
            $paths = [];
            foreach ($request->file('documents') as $document) {
                $paths[] = $document->store('documents');
            }
            $student->documents = json_encode($paths);
        }

        $student->save();

        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if ($student->profile_picture) {
            Storage::delete($student->profile_picture);
        }
        if ($student->documents) {
            foreach (json_decode($student->documents, true) as $document) {
                Storage::delete($document);
            }
        }
        $student->delete();

        return response()->json(null, 204);
    }
}

