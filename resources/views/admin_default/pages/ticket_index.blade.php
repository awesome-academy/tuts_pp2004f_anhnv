@extends('admin_default')

@section('title', '| Ticket List')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (Session::has('message'))
                @include('admin_default.partials.message')
            @endif
            <div class="box box-warning">
                <div class="box-header">
                    <h3>Ticket List</h3>
                </div>
                <div class="box-body">
                    <table id="table_ticket_list" class="table table-bordered table-striped table-hover dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th width="20px"></th>
                                <th width="25%">Title</th>
                                <th>Content</th>
                                <th width="15%">User</th>
                                <th width="140px">Created At</th>
                                <th width="240px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td></td>
                                <td><a href="{{ route('admin.tickets.show', $ticket->id) }}" title="Click to view details">{{ $ticket->title }}</a></td>
                                <td>{{ $ticket->content }}</td>
                                <td></td>
                                <td>{{ date_format($ticket->created_at, 'H:i a - d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-default"><i class="fa fa-eye"></i> View</a>
                                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('admin.tickets.delete', $ticket->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
    <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('js-libs')
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(function(){
            $('#table_ticket_list').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'columns'     : [
                    { orderable: false },
                    { orderable: true },
                    { orderable: true },
                    { orderable: false },
                    { orderable: true },
                    { orderable: false }
                ],
                'order'       : [4, 'desc']
            });
        })(jQuery);
    </script>
@endpush