<style>
    .employees {
    }

    table {
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    table th:not(:last-child) {
        border-right: 1px solid rgba(0, 0, 0, 0.3);
    }

    /* Styling for the .link class */
    .link {
        display: inline-block;
        background-color: #db0909;
        color: #fff;
        padding: 10px 10px;
        border-radius: 5px;
        text-align: center;
        margin: 0 0 20px 0;
        transition: background-color 0.3s ease;
        text-decoration: none;
        float: left;
    }

    .link:hover {
        background-color: #ff0000;
        text-decoration: none;
        color: white;
    }

    .message {
        padding: 10px;
        background-color: green;
        display: block;
        color: white;
        text-align: center;
        margin-bottom: 15px;
    }

    /* Responsive table for mobile devices */
    @media (max-width: 600px) {
        .employees {
            width: 100%; /* Full width for smaller screens */
        }

        thead {
            display: none; /* Hide header visually but keep for accessibility */
        }
    }
</style>

<!DOCTYPE html>
<html>
<head>
    <title>DataTables Example</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="employees">

    <?php if (isset($_SESSION['message'])) { ?>
        <p class="message" <?= $error ?? '' ?> > <?= $_SESSION['message'] ?> </p>
    <?php } unset($_SESSION['message']); ?>

    <a class='link' href="employees/add"><?= $text_add_employee ?></a>
<table id = 'example' class="display">
    <thead>
    <tr>
        <th> <?= $text_table_employee_name ?> </th>
        <th> <?= $text_table_email ?> </th>
        <th> <?= $text_table_employee_address ?> </th>
        <th> <?= $text_table_phone ?> </th>
        <th> <?= $text_table_control ?> </th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (false !== $employees) {
        foreach ($employees

                 as $row) { ?>
            <tr>
                <td><?= $row->name ?> </td>
                <td><?= $row->email ?> </td>
                <td><?= $row->address ?> </td>
                <td><?= $row->phone ?> </td>
                <td>
                    <a href="/employees/edit/<?= $row->customer_id ?>">Edit</a> |
                    <a href="/employees/delete/<?= $row->customer_id ?>" onclick="if(!confirm('<?= $text_delete_confirm ?>')) return false;">Delete</a>
                </td>
            </tr>

        <?php }
    } else { ?>
        <td colspan="4"><p>Sorry, Not Found Employees To List</p></td>
    <?php } ?>
    </tbody>
</table>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>
</html>