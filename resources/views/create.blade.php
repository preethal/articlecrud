@section('title', 'New Article')
@extends('layouts.app')

@section('content')

<h1 class="title">Create a new post</h1>
 @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif
<form method="post" action="{{ url('store')}}" enctype="multipart/form-data">

    @csrf
    @include('partials.errors')

    <div class="field">
        <label class="label">Title</label>
        <div class="control">
            <input type="text" name="title" value="{{ old('title') }}" class="input" placeholder="Title" minlength="5" maxlength="100" />
            @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
             @endif
        </div>
    </div>

    <div class="field">
        <label class="label">Content</label>
        <div class="control">
            <textarea name="content" class="textarea" placeholder="Content" minlength="5" maxlength="2000"  rows="10">{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="label">Category</label>
        <div class="control">
            <div class="select">
                <select name="category_id">
                    <option value="" disabled selected>Select category</option>
                    <?php foreach ($category as $categories): ?>
                    <option value="{{$categories->id}}" {{ old('category') === 'html' ? 'selected' : null }}>{{$categories->category}}</option>
                    <?php endforeach ?>
                    
                    
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        
        <select class="form-control select2 select-tags" name="tag[]" id="tags" multiple>
        @foreach ($tag as $tags)
        <option value="{{$tags->name}}">{{$tags['name']}}</option>
        @endforeach
        </select>
    </div>
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link is-outlined">Publish</button>
        </div>
    </div>

</form>

@endsection

