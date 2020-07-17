@extends('master_admin_def')

@section('title', '| Create New Post')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-file-o"></i> Create New Post</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(['route' => 'admin.posts.store', 'method' => 'POST']) !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('Post Title') !!}
                            {!! Form::text(
                                'title',
                                isset($old['title']) ? $old['title'] : NULL,
                                ['class' => 'form-control' ]
                            ) !!}
                            @error('title')
                                <div class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('Excerpt') !!}
                            {!! Form::textarea(
                                'excerpt',
                                isset($old['excerpt']) ? $old['excerpt'] : NULL,
                                [
                                    'class' => 'form-control',
                                    'rows' => 3
                                ]
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Content') !!}
                            {!! Form::textarea(
                                'content',
                                isset($old['content']) ? $old['content'] : NULL,
                                [
                                    'id' => 'post_content',
                                    'class' => 'form-control',
                                    'rows' => 6
                                ]
                            ) !!}
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                {!! Form::label('Thumbnail Image', NULL, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::file(
                                        'image_thumb',
                                        isset($old['image_thumb']) ? $old['image_thumb'] : NULL,
                                    ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                {!! Form::label('Category', NULL, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    <select name="category" id="" class="form-control">
                                        <option>--- Please Select a category</option>
                                        @foreach($categories as $key => $cate)
                                            <option value="{{ $key }}">{{ $cate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Create</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                            <a href="javascript: history.back();" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-lib')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endpush

@push('js')
    <script>
        $(function(){
            CKEDITOR.replace('post_content');
        })(jQuery);
    </script>
@endpush