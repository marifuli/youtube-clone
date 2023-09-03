@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="/home" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="">Select video files:</label>
                    <input name="videos" type="file" accept="video/*" class="form-control" multiple>
                </div>
                <div class="form-group">
                    <label for="">Name:</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <button class="btn btn-info mt-3">
                    Submit 
                </button>
            </form>        
        </div>
    </div>
    
</div>
@endsection
