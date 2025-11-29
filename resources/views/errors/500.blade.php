<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Terjadi error pada aplikasi kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    a.btn:hover {
        background-color: #264326 !important; /* warna gelap saat hover */
    }
</style>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="text-center">
        <h1 class="fw-bold display-1 text-danger">Error 500</h1>
        <p class="fs-4 mt-3" style="color: #325832;">
            Maaf, terjadi suatu error pada aplikasi kami.
        </p>
        <a href="{{ url('/') }}" class="btn btn-lg text-white mt-4" style="background-color: #325832;">
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>
