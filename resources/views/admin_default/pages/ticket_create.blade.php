@extends('admin_default')

@section('title', '| Ticket List')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3>Create New Ticket</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(['route' => 'admin.tickets.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('afsa', 'Ticket Title', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('title', isset($old['title']) ? $old['title'] : NULL, ['class' => 'form-control']) !!}
                                @if ($errors->has('title'))
                                    <div class="help-block">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            {!! Form::label('asfaf', 'Content', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::textarea('content', isset($old['content']) ? $old['content']: NULL, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Feel free	to ask us any question.',
                                    'rows' => 5
                                ]) !!}
                                @if ($errors->has('content'))
                                    <div class="help-block">
                                        {{ $errors->first('content') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Create</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection