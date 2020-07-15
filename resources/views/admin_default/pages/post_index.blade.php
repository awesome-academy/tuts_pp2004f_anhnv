@extends('master_admin_def')

@section('title', '| Post List')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Post List</h3>
                </div>
                <div class="box-body">
                    @empty(!$errors->first())
                        @include('admin_default.partials.error')    
                    @endempty
                    <table id="post_list" class="table table-bordered table-hover dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th width="140px">Category</th>
                                <th width="128px">Created At</th>
                                <th width="120px">Author</th>
                                <th width="100px">Views</th>
                                <th width="188px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            @php
                                $route = $post->is_published() ? 'admin.posts.show' : 'admin.drafts.show';  
                                if (!empty($post->staff[0])) {
                                    $created_at = date_format(new DateTime($post->staff[0]->pivot->happened_at), 'd/m/Y - H:i A');
                                    $author = $post->staff[0]->username;
                                }
                            @endphp
                            <tr>
                                <td><a href="{{ route($route, $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ !empty($post->category->name) ? $post->category->name : 'Non-Category' }}</td>
                                <td>{{ $created_at }}</td>
                                <td>{{ $author }}</td>
                                <td>{{ $post->views }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> View</a>
                                    <a href="" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('js-lib')
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(function(){
            $('#post_list').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'columns': [
                    {orderable: true},
                    {orderable: true},
                    {orderable: true},
                    {orderable: true},
                    {orderable: true},
                    {orderable: false},
                ],
                'order': [2, 'desc'],
            });
        });
    </script>
@endpush