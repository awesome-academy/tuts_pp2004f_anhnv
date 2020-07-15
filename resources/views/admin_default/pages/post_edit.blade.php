@extends('master_admin_def')

@section('title', '| Create New Post')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-file-o"></i> Edit Post</h3>
                </div>
                <div class="box-body">
                    @empty(!$errors->first())
                        @include('admin_default.partials.error')    
                    @endempty
                    {!! Form::open(['route' => ['admin.drafts.update', $post->id], 'method' => 'PATCH']) !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('Post Title') !!}
                            {!! Form::text(
                                'title',
                                isset($post['title']) ? $post['title'] : NULL,
                                ['class' => 'form-control' ]
                            ) !!}
                            @error('title')
                                <div class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group{{ $errors->has('excerpt') ? ' has-error' : '' }}">
                            {!! Form::label('Excerpt') !!}
                            {!! Form::textarea(
                                'excerpt',
                                isset($post['excerpt']) ? $post['excerpt'] : NULL,
                                [
                                    'class' => 'form-control',
                                    'rows' => 3
                                ]
                            ) !!}
                            @error('excerpt')
                                <div class="help-block">
                                    <strong>{{ $errors->first('excerpt') }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            {!! Form::label('Content') !!}
                            {!! Form::textarea(
                                'content',
                                isset($post['content']) ? $post['content'] : NULL,
                                [
                                    'id' => 'post_content',
                                    'class' => 'form-control',
                                    'rows' => 6
                                ]
                            ) !!}
                            @error('content')
                                <div class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                {!! Form::label('Thumbnail Image', NULL, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::file(
                                        'image_thumb',
                                    ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <div class="row">
                                {!! Form::label('Category', NULL, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    <select name="category_id" class="form-control">
                                        <option value="">--- Please Select a category</option>
                                        @foreach($categories as $key => $cate)
                                            <option value="{{ $key }}" @if($key == $post->category_id) {{ 'selected' }} @endif>{{ $cate }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="help-block">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
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