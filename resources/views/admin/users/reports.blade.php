<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Users Report</title>
</head>
<style>

    @page {
        width: 100%;
        background-color: #ede837;
        font-family: 'Poppins', sans-serif;
    }

    .zui-table {
        border: solid 1px #DDEEEE;
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        font: normal 14px Arial, sans-serif;
    }


    .zui-table thead th {
        background-color: #ede837;
        border: solid 1px #DDEEEE;
        color: #00adef;
        padding: 14px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
    }


    .zui-table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 14px;
        text-shadow: 1px 1px 1px #fff;
    }
    .reports-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between
    }
    footer {
        position: absolute;
        bottom: 0;
        background: #00adef;
        width: 100%;
        padding: 16px 0;
        text-align: center

    }
    footer span {
        color: #ede837;
        text-align: center;
        width: 100%;
        font-weight: 900;
        font-size: 24px;
    }
</style>

<body>
    <div class="reports-header">
        <img src="https://dodoma-logo.s3.eu-north-1.amazonaws.com/logo.png" alt="" width="40%">
        <p style="float: right">printed on <?php echo date('Y-m-d')?></p>
    </div>
    <div>
        <h2 style="text-align: center">DODOMA USERS REPORT</h2>
    </div>
    <table class="zui-table">
        <thead>
            <tr>
                <th>Names</th>
                <th>Role</th>
                <th>Residence</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Tin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->names}}</td>
                <td>{{$user->role->role}}</td>
                <td>{{$user->residence}}</td>
                <td>{{$user->telephone}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->tin}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <span>Matelas Dodoma</span>
    </footer>
</body>

</html>