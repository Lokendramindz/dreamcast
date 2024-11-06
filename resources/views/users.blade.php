<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Styling */
        form#userForm {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        form#userForm input[type="text"],
        form#userForm input[type="email"],
        form#userForm textarea,
        form#userForm select,
        form#userForm input[type="file"],
        form#userForm button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        form#userForm button {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        form#userForm button:hover {
            background-color: #218838;
        }

        /* Table Styling */
        table#userTable {
            width: 100%;
            max-width: 800px;
            background: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table#userTable th, table#userTable td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        table#userTable th {
            background-color: #28a745;
            color: #fff;
        }

        table#userTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        table#userTable img {
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>User Form</h1>
    <form id="userForm" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <textarea name="description" placeholder="Description"></textarea>
        <select name="role_id" required>
            <option value="">Select Role</option>
            <option value="1">Admin</option>
            <option value="2">Admin 1</option>
        </select>
        <input type="file" name="profile_image">
        <button type="submit">Submit</button>
    </form>

    <table id="userTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Description</th>
                <th>Profile Image</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->description}}</td>
            <td><img src="/storage/app/public/images/{{$user->profile_image}}" width="50" alt="Profile Image"/></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="text-align: center;">No roles available</td>
        </tr>
    @endforelse

        </tbody>
    </table>

    <script>
        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            $.ajax({
                url: 'users',
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                   
                    alert(data.message);
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    alert(JSON.stringify(errors));
                }
            });
        });

    
    </script>
</body>
</html>
