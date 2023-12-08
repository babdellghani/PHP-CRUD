<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project - 1</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <?php 
        require_once 'connect.php';
        include_once 'include/nav.php';
        $state = $db->query('SELECT * FROM users');

        $users = $state->fetchAll(PDO::FETCH_ASSOC);
        // ASSOC + OBJ = CLASS => TO SEE INDEX VALUE
        // OBJ + CLASS => <?= $user -> name 
        echo '<pre>';
        //print_r($users);
        //print_r($state->fetchAll(PDO::FETCH_ASSOC));  //=> TABLE ASSOCIATIVE
        //print_r($state->fetchAll(PDO::FETCH_NUM));    //=> TABLE NUMERIC INDEX
        //print_r($state->fetchAll(PDO::FETCH_OBJ));    //=> TABLE OBJECT ANONYM
        //print_r($state->fetchAll(PDO::FETCH_COLUMN)); //=> TABLE COLUMN  =>  HOW MANY COLUMNS IN TABLE
        //print_r($state->fetchAll(PDO::FETCH_CLASS));  //=> TABLE CLASS
        echo '</pre>';
    ?>

    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Users</h1>
            <div>
            <a href="create.php" class="btn btn-primary">Create</a></div>
        </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Age</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
    <tbody class="table-group-divider">
        <?php foreach($users as $user): ?>
            <tr>
                <th scope="row">  <?php echo $user['id']; ?>  </th>
                <td>  <?php echo $user['name']; ?>  </td>
                <td>  <?php echo $user['email']; ?> </td>
                <td> 
                    <?php
                        $color = 'primary';
                        if ($user['age'] >= 30) {
                            $color = 'danger';
                        } elseif ($user['age'] >= 25) {
                            $color = 'warning';
                        } else {
                            $color = 'success';
                        }
                    ?>
                    <span class="badge rounded-pill bg-<?= $color ?>">
                         <?= $user['age'] . ' Years Old'; ?>   
                    </span>
                </td>
                <td>
                    <?php
                        $state = $db->prepare('DELETE * FROM users WHERE id = ?');
                    ?>
                    <a href="update.php?id=<?= $user['id'] ?>" class="btn btn-outline-success btn-sm">Update</a>
                    <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure to delete user <?= $user['name'] ?>?')">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
    </div>

</body>
</html>
