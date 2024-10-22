<style>
    /* Container to hold both form and table side by side */
    .container {
        display: flex;
        justify-content: center;
        outline: none;

    }

    /* Style the form container */
    form {
        width: 100%; /* Adjust width as needed */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }

    /* Style the table rows */
    td {
        padding: 12px;
    }

    input {
        width: 100%;
        padding: 10px;
    }

    input[type="submit"] {
        width: 12%;
        background-color: #a17f0d;
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #ca8f00;
        text-decoration: none;
        cursor: pointer;
    }

    /* Responsive table for mobile devices */
    @media (max-width: 600px) {
        .container {
            flex-direction: column; /* Stack on small screens */
        }

        form, .container {
            width: 100%; /* Full width for smaller screens */
        }
    }

</style>

<div class="container">
    <form method="post">
        <!--        <p class="msg" --><?php //= isset($error) ? 'error' : '' ?><!-- >--><?php //= $msg ?? '' ?><!--</p>-->
        <table>
            <tr>
                <td>
                    <label>
                        <input type="text" name="name" placeholder="Name" required value="<?= $employee->name ?? '' ?>" autocomplete="off" >
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type='email' name='email' placeholder="Email" required value="<?= $employee->email ?? '' ?>" autocomplete="off">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type="text" name="address" placeholder="Address" required value="<?= $employee->address ?? '' ?>"  >
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type="tel" name="phone" placeholder="Phone" required maxlength="11" value="<?= $employee->phone ?? '' ?>" autocomplete="off">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Save" name="submit">
                </td>
            </tr>
        </table>
    </form>
</div>
<!--<a class='link'  href="/employee">Go To List Employees</a>-->