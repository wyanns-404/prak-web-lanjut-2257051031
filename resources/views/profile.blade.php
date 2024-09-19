<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

    @vite('resources/css/app.css')
</head>
<body style="margin: 0; padding: 0;">

    <div class="container w-full h-screen flex justify-center items-center bg-gradient-to-r from-sky-500 to-indigo-500">
        <div class="profile w-96 h-auto flex justify-center items-center flex-col bg-white/30 rounded-xl p-10">
            <div class="img w-40">
                <img class="rounded-full w-full shadow-xl border-4 border-blue-100" src="{{ asset('assets/img/profile.jpg') }}" alt="profile">
            </div>
            <div class="biodata text-center text-blue-100">
                <div class="biodata-data font-bold w-72 m-4 p-2 bg-blue-950/30 rounded-lg">
                    <?= $nama ?>
                </div>
                <div class="biodata-data font-bold w-72 m-4 p-2 bg-blue-950/30 rounded-lg">
                    <?= $kelas ?>
                </div>
                <div class="biodata-data font-bold w-72 m-4 p-2 bg-blue-950/30 rounded-lg">
                    <?= $npm ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>