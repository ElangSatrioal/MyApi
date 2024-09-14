@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Table</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                This week
            </button>
        </div>
    </div>
    @if (session()->has('Success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('Success') }}
        </div>
    @endif
    <div class="table-responsive small col-lg-8">
        <a href="/posts/create" class="btn btn-primary mb-3">Create New Post</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">News Content</th>
                    <th scope="col">Author ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->news_content }}</td>
                        <td>{{ $post->author }}</td>
                        <td>
                            <a href="/post/{{ $post->id }}" class="badge bg-info"><i class="bi bi-eye"></i></a>

                            <a href="/post/{{ $post->id }}/edit" class="badge bg-warning"><i
                                    class="bi bi-pencil"></i></a>

                            <form action="/post/{{ $post->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Are You Sure to Delete??')"><i
                                        class="bi bi-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
