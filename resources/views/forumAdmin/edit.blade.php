<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Forum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-header {
            background-color: #42424a;
            color: white;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
        }

        .btn-gradient-dark {
            background: linear-gradient(195deg, #42424a 0%, #191919 100%);
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            color: white;
            transition: background 0.3s;
        }

        .btn-gradient-dark:hover {
            background: linear-gradient(195deg, #5a5a5a 0%, #2a2a2a 100%);
        }

        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            border-radius: 8px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ url('forum/' . $data->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')
        <div class="card shadow-sm" style="border-radius: 8px; margin: 20px 0;">
            <div class="card-header py-3 px-4 rounded-top">
                <h6 class="mb-0">Edit Forum</h6>
            </div>
            <div class="card-body px-4">
                <div class="form-group mb-3">
                    <label>Nama Forum</label>
                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Judul Forum</label>
                    <input type="text" class="form-control" name="judul" value="{{ $data->judul }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" value="{{ $data->deskripsi }}" required>
                </div>

                @if($data->foto_forum)
                    <div class="form-group mb-3">
                        <label>Foto Saat Ini</label>
                        <div>
                            <img class="img-thumbnail" src="{{ url('foto_forum/' . $data->foto_forum) }}" alt="Foto Forum">
                        </div>
                    </div>
                @endif

                <div class="form-group mb-3">
                    <label for="foto_forum">Upload Foto Baru (Opsional)</label>
                    <input type="file" class="form-control" id="foto_forum" name="foto_forum">
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between px-4 py-3">
                <button type="submit" class="btn btn-gradient-dark btn-sm">
                    Save
                </button>
                <a href="{{ route('forumAdmin') }}" class="btn btn-gradient-dark btn-sm">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

</body>
</html>
