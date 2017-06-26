<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Soacial</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $(".loading").fadeOut();

            if (!navigator.cookieEnabled)
            {
                $('#warningModal').addClass('show');
            }
        });
    </script>

    <div class="modal" tabindex="-1" role="dialog" id="warningModal" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="alert alert-danger">
                <p>Seems like <strong>Cookies</strong> are disabled in this browser. Without <strong>Cookies</strong>, this website will not work.</p>
            </div>
        </div>
    </div>

    <noscript style="width:100%; height:100%; z-index:100000; position:absolute;">
        <div class="modal show" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="alert alert-danger">
                    <p>Seems like <strong>Javascript</strong> is disabled in this browser. Without <strong>Javascript</strong>, this website will not work.</p>
                </div>
            </div>
        </div>
    </noscript>

</head>
<body>
<div class="loading"></div>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo2.png') }}" alt="Brand" style="margin-top: -15px; max-width: 50px;">
            </a>
        </div>
    </div>
</nav>
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                <strong> Success! </strong>{{ session()->get('success') }}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                <strong> Error! </strong>{{ session()->get('error') }}
            </div>
        @endif
    </div>
</body>
</html>