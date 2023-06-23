<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXCEL Veri Aktarımı</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5 border rounded ">
    <div class="row mx-auto">
        <div class="col-12 mt-3 mx-auto">
            <form action="{{ route('users.importable') }}" method="post">
                @csrf
                <button class="btn btn-success" type="submit">Verileri İçe Aktar</button>
            </form>
        </div>
        <div class="col-12 mt-3 ">
            <form action="{{ route('personal.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                Yüklenecek excel dosyasını seçin:
                <input type="file" name="files[]" id="fileToUpload" multiple>
                <input type="submit" value="Upload Excel" name="submit">
            </form>
        </div>
        <div class="col-4 mt-3">
                    <form action="{{ route('file.seed') }}" method="post">
                        @csrf
                        <button class="btn btn-success" type="submit">Verileri Seed Et</button>
                    </form>
        </div>
        <div class="col-4 mt-3">
                    <form action="{{ route('file.export') }}" method="post">
                        @csrf
                        <button class="btn btn-success" type="submit">Verileri Dışa Aktar</button>
                    </form>
        </div>
        <div class="col-4 mt-3 mb-3">
                    <form action="{{ route('file.delete') }}" method="post">
                        @csrf
                        <button class="btn btn-success" type="submit">Verileri Sil</button>
                    </form>
        </div>
        <div class="col-4 mt-3 mb-3">
                    <form action="{{ route('personal.export') }}" method="post">
                        @csrf
                        <button class="btn btn-success" type="submit">İndir</button>
                    </form>
        </div>
        <div class="col-4 mt-3 mb-3">
            <form action="{{ route('personal.excel-save') }}" method="post">
                @csrf
                <button class="btn btn-success" type="submit">Excele Aktar</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
