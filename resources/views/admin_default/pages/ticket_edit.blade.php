@extends('admin_default')

@section('title', '| Edit Ticket')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3>Edit Ticket</h3>
                </div>
                <div class="box-body">
                    {!! Form::open([
                        'route' => [$ticket->trashed() ? 'admin.tickets.updateTrashed' : 'admin.tickets.update', $ticket->id],
                        'method' => 'PATCH',
                        'class' => 'form-horizontal'
                    ]) !!}
                        <div class="form-group">
                            {!! Form::label('Title', NULL, ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('title', $ticket->title, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Content', NULL, ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::textarea('content', $ticket->content, ['class' => 'form-control', 'rows' => 5]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <label for="">
                                    {{ Form::checkbox('status', NULL, ['class' => 'form-control', 'checked' => $ticket->status ? '' : true]) }} Close this ticket?
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Update</button>
                                @if (!$ticket->trashed())
                                    <a href="{{ route('admin.tickets.delete', $ticket->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                @endif
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                <a href="{{ route($ticket->trashed() ? 'admin.tickets.showTrashed' : 'admin.tickets.show', $ticket->id) }}"
                                    class="btn btn-default"><i class="fa fa-close"></i> Cancel</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection