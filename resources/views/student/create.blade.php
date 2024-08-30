<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
    <h1>Student Registration Form</h1>
    <form action="{{ url('/students') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div>
            <label>Gender:</label>
            <label><input type="radio" name="gender" value="Male" required> Male</label>
            <label><input type="radio" name="gender" value="Female"> Female</label>
            <label><input type="radio" name="gender" value="Other"> Other</label>
        </div>

        <div>
            <label for="education">Education:</label>
            <select id="education" name="education" required>
                <option value="High School">High School</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Postgraduate">Postgraduate</option>
            </select>
        </div>

        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
        </div>

        <div>
            <label for="phone_number">Phone Number:</label>
            <input type="number" id="phone_number" name="phone_number" required>
        </div>

        <div>
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
        </div>

        <div>
            <label for="documents">Documents:</label>
            <input type="file" id="documents" name="documents[]" multiple>
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
