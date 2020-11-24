<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            <th scope="col">Role</th>
            <th scope="col">Approve</th>
            <th scope="col">Unapprove</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
<?php
        if ($result = getAllUsers()) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
?>
                <tr>
                    <!-- <td scope="row"><?php echo $row["user_id"]; ?></td> -->
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td scope="row"><?php echo $row["user_username"]; ?></td>
                    <td scope="row"><?php echo $row["user_firstname"]; ?></td>
                    <td scope="row"><?php echo $row["user_lastname"]; ?></td>
                    <td scope="row"><?php echo $row["user_email"]; ?></td>
                    <td scope="row">
                        <img src="../images/<?php echo $row["user_image"]; ?>" alt="<?php echo $row["user_image"]; ?>" width="20">
                    </td>
                    <td scope="row"><?php echo $row["user_role"]; ?></td>
                    <td scope="row">
                        <a href="?make_admin=<?php echo $row["user_id"]; ?>">Make Admin</a>
                    </td>
                    <td scope="row">
                        <a href="?make_subscriber=<?php echo $row["user_id"]; ?>">Make Subscriber</a>
                    </td>
                    <td scope="row">
                        <a href="?source=edit_users&id=<?php echo $row["user_id"]; ?>">Edit</a>
                    </td>
                    <td scope="row">
                        <a href="?delete=<?php echo $row["user_id"]; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                    </td>
                </tr>
<?php
            }
        }
?>
    </tbody>
</table>
