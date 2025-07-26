<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_GET["id"])) {
        header("location: /myshop/idx.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /myshop/idx.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    // POST method: update
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "⚠️ All the fields are required.";
            break;
        }

        $sql = "UPDATE clients SET 
                    name = '$name', 
                    email = '$email', 
                    phone = '$phone', 
                    address = '$address' 
                WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "❌ Invalid query: " . $connection->error;
            break;
        }

        $successMsg = "✅ Client updated successfully.";
        header("location: /myshop/idx.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update Client</title>
  <!-- Tailwind + DaisyUI -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.8.0/dist/full.css" rel="stylesheet" type="text/css" />
  <!-- Alpine.js for alert behavior -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-xl">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Update Client</h1>

    <!-- Error Message Popup -->
    <?php if (!empty($errorMessage)) : ?>
      <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        x-transition.duration.300ms
        class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded shadow">
        <?php echo $errorMessage; ?>
      </div>
    <?php endif; ?>

    <!-- Success Message Popup -->
    <?php if (!empty($successMsg)) : ?>
      <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        x-transition.duration.300ms
        class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded shadow">
        <?php echo $successMsg; ?>
      </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <div>
        <label class="block font-medium text-gray-700 mb-1">Name</label>
        <input class="input input-bordered w-full" type="text" name="name" value="<?php echo $name; ?>">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Email</label>
        <input class="input input-bordered w-full" type="text" name="email" value="<?php echo $email; ?>">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Phone</label>
        <input class="input input-bordered w-full" type="text" name="phone" value="<?php echo $phone; ?>">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Address</label>
        <input class="input input-bordered w-full" type="text" name="address" value="<?php echo $address; ?>">
      </div>

      <div class="flex justify-between items-center mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/myshop/idx.php" class="btn btn-error">Cancel</a>
      </div>
    </form>
  </div>
</body>

</html>
