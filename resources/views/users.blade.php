<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="userForm" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone" required><br>
        <textarea name="description" placeholder="Description"></textarea><br>
        <select name="role_id" required>
            <option value="">Select Role</option>
            <!-- Populate roles from the database -->
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
            @endforeach
        </select><br>
        <input type="file" name="profile_image"><br>
        <button type="submit">Submit</button>
    </form>

    <table id="userTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Description</th>
                <th>Role</th>
                <th>Profile Image</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be appended here -->
        </tbody>
    </table>

    <script>
        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            $.ajax({
                url: '/api/users',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    fetchUsers();
                    alert(data.message);
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    alert(JSON.stringify(errors));
                }
            });
        });

        function fetchUsers() {
            $.ajax({
                url: '/api/users',
                type: 'GET',
                success: function(users) {
                    const userTable = $('#userTable tbody');
                    userTable.empty();
                    users.forEach(user => {
                        userTable.append(`<tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.phone}</td>
                            <td>${user.description}</td>
                            <td>${user.role.role_name}</td>
                            <td><img src="/storage/images/${user.profile_image}" width="50" /></td>
                        </tr>`);
                    });
                }
            });
        }

        // Initial fetch of users
        fetchUsers();
    </script>
</body>
</html>
