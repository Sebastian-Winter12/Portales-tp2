<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link href=" {{ url('css/bootstrap.min.css') }} " rel="stylesheet">
</head>

<body>
  @if (session()->has('feedback.message'))
  <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="alert alert-success">
                {!! session()->get('feedback.message') !!}
            </div>
          </div>
        </div>
   </div>
    
    
  @endif
  @yield('content')
    
  <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>