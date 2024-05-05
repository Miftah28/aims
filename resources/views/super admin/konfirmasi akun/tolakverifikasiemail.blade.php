<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohon Maaf Anda Tidak Terverifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .verification-container {
            text-align: center;
            margin: 100px auto;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .verification-message {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="verification-container">
        <h1>Mohon Maaf Anda Tidak Terverifikasi</h1>
        <p class="verification-message">
            Akun Anda Tidak Diterima oleh admin, Karena {{$keterangan}}
        </p>
    </div>
</body>

</html>