<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <h2 class="font-bold text-xl">List of Clients</h2>
    <a class="btn btn-primary m-2" href="/myshop/create.php">New Client</a>
    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Address</th>
                    <th class="px-6 py-3">Created At</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "myshop";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("Connection failed" . $connection->connect_error);
                }

                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid Query" . $connection->connection_error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                <tr class='hover:bg-gray-50 transition'>
                    <td class='px-6 py-4'>$row[id]</td>
                    <td class='px-6 py-4'>$row[name]</td>
                    <td class='px-6 py-4'>$row[email]</td>
                    <td class='px-6 py-4'>$row[phone]</td>
                    <td class='px-6 py-4'>$row[address]</td>
                    <td class='px-6 py-4'>$row[created_at]</td>
                    <td class='px-6 py-4 space-x-2'>
                        <a class='inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                        <a class='inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>