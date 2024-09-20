<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
</head>
<body>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama">Nama:</label>
            <input type="text" name="nama">
        </div>

        <div>
            <label for="kelas">Kelas:</label>
            <input type="text" name="kelas">
        </div>

        <div>
            <label for="npm">NPM:</label>
            <input type="text" name="npm">
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>