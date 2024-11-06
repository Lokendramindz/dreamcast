<!-- resources/views/roles/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 8px; }
        button { padding: 10px 15px; background-color: #ffc107; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #e0a800; }
        .back-link { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

    <h1>Edit Role</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="role_name">Role Name:</label>
            <input type="text" name="role_name" id="role_name" value="{{ $role->role_name }}" required>
        </div>
        <button type="submit">Update Role</button>
    </form>

    <p><a href="{{ route('roles.index') }}" class="back-link">Back to Roles List</a></p>

</body>
</html>
