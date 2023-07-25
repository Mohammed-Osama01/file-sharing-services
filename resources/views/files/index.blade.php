<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>

<body>


    <div class="container py-5">

        @if ($success)
            <div class="alert alert-success">{{ $success }}</div>
        @endif

        <h1>Files</h1>
        <a href="{{ route('files.create') }}" class="btn btn-success px-3 my-2">Upload </a>
        <div class="row">

            @foreach ($files as $file)
                <div class="my-4 col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>{{ $file->title }}</h5>
                        </div>
                        <div class="card-body">
                            @if ($file->cover_path && !str_ends_with($file->cover_path, 'pdf'))
                                <img src="{{ asset('storage/' . $file->cover_path) }}" alt=""
                                    class="img-thumbnail my-img">
                            @endif
                            <p class="card-text mt-2 text-center">{{ $file->description }}</p>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('files.download', $file->id) }}"
                                        class="btn btn-primary">Download</a>
                                </div>
                                <div>
                                    <form method="POST" action="{{ route('files.destroy', $file->id) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn-delete btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>


</body>

</html>
