@extends('admin_default')

@section('title', '| Ticket Details')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3>Ticket Details</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(['class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('Title', NULL, ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('title', $ticket->title, ['class' => 'form-control', 'readonly' => true]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Content', NULL, ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::textarea('content', $ticket->content, ['class' => 'form-control', 'rows' => 5, 'readonly' => true]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Created At', NULL, ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('created_at', $ticket->created_at, ['class' => 'form-control', 'readonly' => true]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Status', NULL, ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {{ Form::text('status', $ticket->status ? 'Pending': 'Answered', ['class' => 'form-control', 'readonly' => true]) }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                @if ($ticket->trashed())
                                    <label class="btn btn-primary btn-restore-ticket" for="btn-restore-ticket"><i class="fa fa-refresh"></i> Restore</label>
                                    <a href="{{ route('admin.tickets.editTrashed', $ticket->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <label class="btn btn-danger btn-delete-ticket" for="btn-destroy-ticket"><i class="fa fa-ban"></i> Delete</label>
                                    <a href="{{ route('admin.tickets.trash') }}" class="btn btn-default"><i class="fa fa-list"></i> Back to Trash</a>
                                @else
                                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('admin.tickets.delete', $ticket->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-default"><i class="fa fa-list"></i> Back to Ticket List</a>
                                @endif
                            </div>
                        </div>
                    {!! Form::close() !!}
                    
                    @if ($ticket->trashed())
                        {!! Form::open(['route' => ['admin.tickets.destroy', $ticket->id], 'method' => 'DELETE', 'id' => 'form-delete-ticket']) !!}
                            <input type="submit" class="hidden" id="btn-destroy-ticket">
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['admin.tickets.restore', $ticket->id], 'method' => 'PATCH', 'id' => 'form-restore-ticket']) !!}
                            <input type="submit" class="hidden" id="btn-restore-ticket">
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <div id="modal-confirm-delete" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Please Confirm </h4>
            </div>
            <div class="modal-body">
                Do you really want to delete this Ticket?
            </div>
            <div class="modal-footer">
                <button id="btn-confirm-delete" type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Yes, Delete it!</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

    <div id="modal-confirm-restore" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Please Confirm </h4>
            </div>
            <div class="modal-body">
                Do you really want to restore this Ticket?
            </div>
            <div class="modal-footer">
                <button id="btn-confirm-restore" type="button" class="btn btn-primary"><i class="fa fa-ban"></i> Yes, restore it!</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>
<script>
    $('.btn-delete-ticket').click(function(event){
        event.preventDefault();
        $('#modal-confirm-delete').modal({
            show: true,
            backdrop: 'static'
        });
        $('#btn-confirm-delete').click(function(){
            $('#form-delete-ticket').submit();
        });
    });

    $('.btn-restore-ticket').click(function(event){
        event.preventDefault();
        $('#modal-confirm-restore').modal({
            show: true,
            backdrop: 'static'
        })
        $('#btn-confirm-restore').click(function(){
            $('#form-restore-ticket').submit();
        });
    });
</script>
@endpush