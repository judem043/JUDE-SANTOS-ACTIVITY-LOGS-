<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <form action="logout.php" method="POST">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>


    <div class="centered-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
            <input type="text" name="searchInput" placeholder="Search here">
            <input type="submit" name="searchBtn" value="Search">
        </form>

        <p><a href="index.php">Clear Search Query</a></p>
        <p><a href="insert.php">Insert New User</a></p>
    </div>

    <table style="width:100%; margin-top: 20px;">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Expertise</th>
            <th>Years of Experience</th>
            <th>Nationality</th>
            <th>Address</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>

        <?php if (!isset($_GET['searchBtn'])) { ?>
            <?php $getAllUsers = getAllUsers($pdo); ?>
                <?php foreach ($getAllUsers as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['expertise']); ?></td>
                        <td><?php echo htmlspecialchars($row['yearsOfExperience']); ?></td>
                        <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
            <?php } ?>
            
        <?php } else { ?>
            <?php $searchForAUser =  searchForAUser($pdo, $_GET['searchInput']); ?>
                <?php foreach ($searchForAUser as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['expertise']); ?></td>
                        <td><?php echo htmlspecialchars($row['yearsOfExperience']); ?></td>
                        <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
        <?php } ?>    
        
    </table>
</body>
</html>
