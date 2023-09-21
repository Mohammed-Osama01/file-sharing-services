@extends('layouts.master')
@section('title', 'Home | File Sharing')
@section('content')

    <x-alert :msg="$msg" :type="$type" />
    @if (!$files->count())
        <p class="alert alert-warning">No Files</p>
    @endif
    <div class="d-flex justify-content-end">
        <a href="{{ route('upload') }}" class="btn btn-outline-danger mb-2 ">Upload Now!<i
                class="fa-solid fa-upload mx-3"></i></a>
    </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($files as $file)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $file->title }}</h5>
                                <h5 class="card-title">File Extension: {{ strtoupper(substr(strstr($file->path, '.'), 1)) }}</h5>
                                <p class="card-text">{{ $file->unique_identifier }}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted"><a href="{{ route('files.download', $file->id) }}"
                                        class="btn btn-primary"><i class="fa-solid fa-download"></i></a>
                                    <button class="btn-delete btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    <form action="{{ route('files.delete', $file->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </small>
                                <div class="mt-3">{{ $file->total_downloads }} <i class="fa-regular fa-eye"></i></div>
                                <div class="mt-3"> <i class="fa-solid fa-pen me-3"></i>{{ $file->created_at->diffForHumans() }} </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
    {{ $files->withQueryString()->links() }}

@endsection


@push('scripts')
    <x-delete-btn />
@endpush
