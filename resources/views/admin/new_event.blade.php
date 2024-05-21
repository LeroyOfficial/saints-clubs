<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Add a New Event';
@endphp
<head>
    @include('components.admin.css')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('components.admin.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('components.admin.top-nav')
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Add an Event for {{$club->name}}</h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">Add an Event for {{$club->name}}</h5>

                                </div>
                                <div class="card-body">
                                    <form action="{{url('admin/club/'.$club->id.'/post_new_event')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <img id="preview">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="image-input">
                                                    <strong>Poster</strong>
                                                </label>
                                                <input class="form-control" type="file" id="image-input" accept="image/*" name="poster" required>

                                                <script>
                                                    var imageinput = document.getElementById("image-input");
                                                    var preview = document.getElementById("preview");

                                                    imageinput.addEventListener("change", function(event){
                                                        if(event.target.files.lenght == 0) {
                                                            return;
                                                        }
                                                        var tempUrl = URL.createObjectURL(event.target.files[0]);
                                                        preview.setAttribute("src",tempUrl);
                                                        var style = "max-width:100%; height:30vh; border-radius:10px;";
                                                        preview.setAttribute("style", style);
                                                    })
                                                </script>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">
                                                        <strong>Event Name</strong>
                                                    </label>
                                                    <input class="form-control" name="name" type="text" id="name" placeholder="Event Name" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="venue">
                                                        <strong>Venue</strong>
                                                    </label>
                                                    <input class="form-control" name="venue" type="text" id="venue" placeholder="Venue" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="date_and_time">
                                                        <strong>Date And Time</strong>
                                                    </label>
                                                    <input class="form-control" name="date_and_time" type="datetime-local" id="date_and_time" placeholder="Date And Time" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="details">
                                                        <strong>Details</strong>
                                                    </label>
                                                    <textarea name="details" id="details" rows="5" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.admin.footer')
</body>

</html>
