<?php
$servername = "";
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

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET["id"])){
        header("location: /myshop/idx.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /myshop/idx.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">New Client</h1>

        <?php
        if (!empty($errorMessage)) {
            echo "<div class='mb-4 p-3 bg-red-100 text-red-700 rounded'>$errorMessage</div>";
        }
        ?>

        <input type="hidden" value="<?php echo $id; ?>">
        <form method="post" class="space-y-4">
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

            <?php
            if (!empty($successMsg)) {
                echo "<div class='mb-4 p-3 bg-green-100 text-green-700 rounded'>$successMsg</div>";
            }
            ?>

            <div class="flex justify-between items-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-error" href="/myshop/idx.php">Cancel</a>
            </div>
        </form>
    </div>
</body>


</html>