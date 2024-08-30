<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
</head>
<body>
    <h1>Student Details</h1>
    <div>
        <p><strong>First Name:</strong> {{ $student->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $student->last_name }}</p>
        <p><strong>Gender:</strong> {{ $student->gender }}</p>
        <p><strong>Education:</strong> {{ $student->education }}</p>
        <p><strong>Address:</strong> {{ $student->address }}</p>
        <p><strong>Phone Number:</strong> {{ $student->phone_number }}</p>
        
        @if($student->profile_picture)
            <p><strong>Profile Picture:</strong></p>
            <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture" style="max-width: 200px;">
        @endif

        @if($student->documents)
            <p><strong>Documents:</strong></p>
            @foreach(json_decode($student->documents, true) as $document)
                <a href="{{ asset('storage/' . $document) }}" target="_blank">View Document</a><br>
            @endforeach
        @endif
    </div>
</body>
</html>
