@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="/home" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="">Select video files:</label>
                    <input name="videos[]" type="file" accept="video/*" class="form-control" multiple>
                </div>
                <div class="form-group">
                    <label for="">Name:</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Category:</label>
                    <input name="category" type="text" class="form-control">
                </div>
                <button class="btn btn-info mt-3">
                    Submit 
                </button>
            </form>        
        </div>
    </div>
    <div class="mt-3 row">
        @if (!count($videos))
            <h1>Nothing fouond!</h1>
        @endif
        @foreach ($videos as $item)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card">
                <video controls onloadedmetadata="get(this)" src="/storage/{{ $item->path }}" class="w-100"></video>
                    <h5 class="card-header">
                        {{ $item->name }}
                        <br>
                        <small>
                            <a href="/home?category={{ $item->category }}">{{ $item->category }}</a>
                        </small>
                    </h5>
                </div>
            </div>
        @endforeach
        <div class="mt-2">
            {{ $videos->links() }}
        </div>
    </div>
</div>
<script>
    function get(v)
    {
        // document.querySelectorAll('video').forEach(v => {
            v.currentTime = v.duration / 4
        // })
    }
</script>
@endsection
