<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="{{ url('/students/' . $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $student->first_name }}" required>
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ $student->last_name }}" required>
        </div>

        <div>
            <label>Gender:</label>
            <label><input type="radio" name="gender" value="Male" {{ $student->gender == 'Male' ? 'checked' : '' }} required> Male</label>
            <label><input type="radio" name="gender" value="Female" {{ $student->gender == 'Female' ? 'checked' : '' }}> Female</label>
            <label><input type="radio" name="gender" value="Other" {{ $student->gender == 'Other' ? 'checked' : '' }}> Other</label>
        </div>

        <div>
            <label for="education">Education:</label>
            <select id="education" name="education" required>
                <option value="High School" {{ $student->education == 'High School' ? 'selected' : '' }}>High School</option>
                <option value="Undergraduate" {{ $student->education == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                <option value="Postgraduate" {{ $student->education == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
            </select>
        </div>

        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required>{{ $student->address }}</textarea>
        </div>

        <div>
            <label for="phone_number">Phone Number:</label>
            <input type="number" id="phone_number" name="phone_number" value="{{ $student->phone_number }}" required>
        </div>

        <div>
            <label for="profile_picture">Profile Picture:</label>
            @if($student->profile_picture)
                <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture" style="max-width: 200px;">
            @endif
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
        </div>

        <div>
            <label for="documents">Documents:</label>
            @if($student->documents)
                @foreach(json_decode($student->documents, true) as $document)
                    <a href="{{ asset('storage/' . $document) }}" target="_blank">View Document</a><br>
                @endforeach
            @endif
            <input type="file" id="documents" name="documents[]" multiple>
        </div>

        <button type="submit">Update</button>
    </form>
</body>
</html>
