<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Video Dwiki</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Video Dwiki</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- You can add more navbar items here if needed -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <h2 class="text-center">Feed</h2>
        @foreach ($feed as $feeds)
            <div class="position-relative d-inline-block">
                <video width="640" height="360" controls class="card-img-top">
                    <source src="{{ asset('/storage/'.$feeds->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <form action="{{ route('feed.destroy',$feeds->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin video ini?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
                <div>{{ $feeds->created_at->format('d F Y') }}</div>
                <div>{{ $feeds->caption }}</div>
            </div>
            <br>
        @endforeach
        {{ $feed->links('pagination::bootstrap-4') }}
        <a class="btn btn-success" href="{{ route('feed.create') }}">Add</a>
    </div>

    <!-- Logout Button -->
    <div class="container mt-3 text-center">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-warning" type="submit">{{ __('Logout') }}</button>
        </form>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
