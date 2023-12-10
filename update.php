<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php
        include_once 'include/nav.php';
        require_once 'connect.php';
    ?>

    <div class="container">
        <br>
        <?php
            $id = $_GET['id']; 
            $state = $db->prepare('SELECT * FROM users WHERE id = ?');
            $state->execute([$id]);

            //fetch not fetch all
            $user = $state->fetch(PDO::FETCH_OBJ);

            if (isset($_POST['update'])) {
                $name  = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $age   = htmlspecialchars($_POST['age']);

                if (empty($name) || empty($email) || empty($age)) {
                    echo '  
                            <div class="alert alert-danger" role="alert">
                                Required Fields
                            </div>
                         ';
                } else {
                    $state = $db->prepare('UPDATE users SET name = ?, email = ?, age = ? WHERE id = ?');
                    $state->execute([$name, $email, $age, $id]);
                    header('Location: index.php');
                    exit();
                } 
            }
        ?>
        <form  method="POST">
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?= $user -> name ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="<?= $user -> email ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Age</label>
                <input type="text" name="age" class="form-control" value="<?= $user -> age ?>">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>
</html>
