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
        /*background-color: #9c7d16;*/
        /*color: black;*/
        /*border: none;*/
        /*border-radius: 5px 5px;*/
        /*cursor: pointer;*/
        /*padding: 10px 20px;*/
        width: 12%;
        display: inline-block;
        background-color: #a17f0d;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        margin: 20px 0;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #cf9802;
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

<form method="post">
    <!--        <p class="msg" --><?php //= isset($error) ? 'error' : '' ?><!-- >--><?php //= $msg ?? '' ?><!--</p>-->
    <table>
        <tr>
            <td>
                <label>
                    <input type="text" name="name" placeholder="Write name" required value="<?= $employees->name ?? "" ?>" autocomplete="off">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type='email' name='email' placeholder="Write email" required value="<?= $employees->email ?? '' ?>" autocomplete="off">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="text" name="address" placeholder="Write address" required value="<?= $employees->address ?? '' ?>"  >
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="tel" name="phone" placeholder="Write phone" required maxlength="11" value="<?= $employees->phone ?? '' ?>" autocomplete="off">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Save" name="submit">
            </td>
        </tr>
</form>