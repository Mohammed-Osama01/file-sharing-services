<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>


    <div class="container mt-5">

        <h1>Upload New File Here!</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    id="title" placeholder="Title">
                <label for="title">Title</label>
                @error('title')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" placeholder="Description">
                <label for="description">Description</label>
                @error('description')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="file" class="form-control @error('cover_path') is-invalid @enderror" name="cover_path"
                    id="cover_path">
                <label for="cover_path">Cover path</label>
                @error('cover_path')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Upload</button>

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
