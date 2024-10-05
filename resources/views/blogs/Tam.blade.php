@extends('layouts.master')

@section('title')
    {{ __('Blogs List View') }}
@endsection

@section('content')
    <x-page-title title="Blog List View" pagetitle="Blog" />

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <div class="card" id="blogsTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Blogs List</h6>

                        <div class="shrink-0">
                            <a href=""
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add
                                    Blog</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-bordered table-hover" id="blogs-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ Str::limit($blog->content, 50) }}</td>
                                    {{-- <td>
                                        <a href="{{ route('blogs.edit', $blog->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
