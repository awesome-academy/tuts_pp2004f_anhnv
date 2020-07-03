@extends('admin_default')

@section('title', '| Ticket Details')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @if (Session::has('message'))
                @include('admin_default.partials.message')
            @endif
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
                            <div class="col-sm-8 col-sm-offset-4">
                                @if ($ticket->trashed())
                                    <label class="btn btn-primary" for="btn-restore-ticket"><i class="fa fa-refresh"></i> Restore</label>
                                    <a href="{{ route('admin.tickets.editTrashed', $ticket->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <label class="btn btn-danger" for="btn-destroy-ticket"><i class="fa fa-ban"></i> Remove</label>
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
                        {!! Form::open(['route' => ['admin.tickets.destroy', $ticket->id], 'method' => 'DELETE']) !!}
                            <input type="submit" class="hidden" id="btn-destroy-ticket">
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['admin.tickets.restore', $ticket->id], 'method' => 'PATCH']) !!}
                            <input type="submit" class="hidden" id="btn-restore-ticket">
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection