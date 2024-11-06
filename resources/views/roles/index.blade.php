<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        a, button {
            color: #fff;
            background-color: #007bff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px;
        }
        a:hover, button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .delete-form {
            display: inline;
        }
    </style>
</head>
<body>

    <h1>Roles</h1>
    <a href="{{ route('roles.create') }}" style="background-color: #28a745;">Add New Role</a>

    @if (session('success'))
        <div style="margin: 20px 0; color: green;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->role_name }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('roles.edit', $role->id) }}" style="background-color: #ffc107;">Edit</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; border: none;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">No roles available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
