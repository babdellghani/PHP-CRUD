<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>

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
            if (isset($_POST['submit'])) {
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
                    $state = $db->prepare('INSERT INTO users VALUES (null,?,?,?)');
                    $state->execute([$name, $email, $age]);
                    header('Location: index.php');
                    exit();
                } 
            }
        ?>
        <form  method="POST">
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Age</label>
                <input type="text" name="age" class="form-control" >
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
</html>
