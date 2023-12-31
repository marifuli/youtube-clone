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
            <div onclick="show('{{ $item->name }}', '/storage/{{ $item->path }}', {{ $item->id }})" 
                 class="col-sm-6 col-md-4 col-lg-3 d-inline-block">
                <div class="card">
                    <video onloadedmetadata="get(this)" src="/storage/{{ $item->path }}" class="w-100"
                        onfocus="this.play()"
                        onmousemove="this.play()"
                        ontouchstart="this.play()"
                        onmouseout="this.pause()"
                        ontouchend="this.pause()"
                        muted
                    ></video>
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

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary modal-btn d-none " data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <video src="" controls class="w-100 modal-video"></video>
          <a type="button" class="btn btn-sm btn-danger modal-delete" href="/delete">
            Delete 
          </a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
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
    function show (title, src, id) {
        document.querySelector('.modal-title').innerText = title 
        document.querySelector('.modal-video').src = src  
        document.querySelector('.modal-delete').href = '/delete/' + id
        document.querySelector('.modal-btn').click() 
    }
</script>
@endsection
