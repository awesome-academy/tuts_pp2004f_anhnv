@extends('master_admin_def')

@section('title', '| Draft Details')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Post Details</h3>
                </div>
                <div class="box-body">
                    @empty(!$errors->first())
                        @include('admin_default.partials.error')    
                    @endempty
                    {!! Form::open(['route' => [$route, $post->id], 'method' => 'PATCH']) !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('Post Title') !!}
                            {!! Form::text(
                                'title',
                                $post->title,
                                [
                                    'class' => 'form-control',
                                    'readonly' => true
                                ]
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Excerpt') !!}
                            {!! Form::textarea(
                                'excerpt',
                                $post->excerpt,
                                [
                                    'class' => 'form-control',
                                    'rows' => 3,
                                    'readonly' => true
                                ]
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Content') !!}
                            {!! Form::textarea(
                                'content',
                                $post->content,
                                [
                                    'id' => 'post_content',
                                    'class' => 'form-control',
                                    'rows' => 6,
                                    'readonly' => true
                                ]
                            ) !!}
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                {!! Form::label('Thumbnail Image', NULL, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    @isset($post->image_thumb)
                                        <img src="{{ $post->image_thumb }}" alt="" class="img-responsive" width="180px">
                                    @else
                                        Not Available
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                {!! Form::label('Category', NULL, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {{ !empty($post->category->name) ? $post->category->name : 'Non Category' }}
                                    <input type="hidden" name="category_id" value="{{ $post->category_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @if (!$post->is_published())
                                @if ($post->is_deleted())
                                    <button type="submit" name="action" value="restore" class="btn btn-primary"><i class="fa fa-refresh"></i> Restore</button>
                                    <button type="submit" name="action" value="delete" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                @else 
                                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Publish</button>
                                    <a href="{{ route('admin.drafts.edit', $post->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('admin.drafts.trash', $post->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Remove</a>
                                @endif
                            @else
                                <button type="submit" name="action" value="unpublish" class="btn btn-warning"><i class="fa fa-arrow-circle-down"></i> Unpublish</button>
                                <button type="submit" name="action" value="unpublish_edit" class="btn btn-warning"><i class="fa  fa-edit"></i> Unpublish & Edit</button>
                            @endif
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
            CKEDITOR.replace('post_content', {
                readOnly: true
            });
        })(jQuery);
    </script>
@endpush