<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SOAcial</title>

    <link rel="icon" href="{{ asset('soacial.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imageviewer/0.5.1/viewer.min.css">
    <link rel="stylesheet" href="{{ asset('/css/jquery.guillotine.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/notify.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('/css/loading-bar.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('/css/loading.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('/css/bootstrap-tagsinput.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/bootstrap-typeahead.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.guillotine.min.js') }}"></script>
    <script src="{{ asset('/js/notify.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imageviewer/0.5.1/viewer.min.js"></script>
    <script src="{{ asset('/js/custom.js') }}"></script>
    {{--<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>--}}
    {{--<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>--}}
    {{--<script src="{{ asset('/js/select2.min.js') }}"></script>--}}
    {{--<script src="{{ asset('/js/loading-bar.js') }}"></script>--}}
    {{--<script src="{{ asset('/js/bootstrap-tagsinput.js') }}"></script>--}}
    {{--<script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>--}}
    {{--<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>--}}

    <script>
        $(document).ready(function() {

            $(".loading").fadeOut();

            if (!navigator.cookieEnabled)
            {
                $('#warningModal').addClass('show');
            }

            $('[data-toggle=tooltip]').tooltip();
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

    <?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: text/html');?>
</head>
<body>
<div class="loading"></div>

{{--@if(!Auth::check())
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo2.png') }}" alt="Brand" style="margin-top: -15px; max-width: 50px;">
        </a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li role="button" ><a data-toggle="modal" data-target="#myModallogin">Login</a></li>
                <li role="button" ><a data-toggle="modal" data-target="#myModalregister">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
@endif--}}

@include('template.navbar')
@yield('content')

{{--<script>
    var onloadCallback = function() {

        @if(!Auth::check())
        //login form
        widgetId1 = grecaptcha.render('recaptcha1', {
            'sitekey' : '6LcI4SgUAAAAADpITy9vbUJADnJ6vAkofQKDK1WN'
        });

        //register form
        widgetId2 = grecaptcha.render('recaptcha2', {
            'sitekey' : '6LcI4SgUAAAAADpITy9vbUJADnJ6vAkofQKDK1WN'
        });

        //forgot password form
        widgetId3 = grecaptcha.render('recaptcha3', {
            'sitekey' : '6LcI4SgUAAAAADpITy9vbUJADnJ6vAkofQKDK1WN'
        });
        @endif
    };
</script>--}}
</body>
<footer class="footer">
    <div class="container text-center">
        <ul class="list-inline">
            <li role="button" data-toggle="modal" data-target="#terms"><a href=""></a>Terms</li>
            <li role="button" data-toggle="modal" data-target="#privacy"><a href=""></a>Privacy</li>
            <li role="button" data-toggle="modal" data-target="#contactUs"><a href=""></a>Contact</li>
            <li role="button" data-toggle="modal" data-target="#about"><a href=""></a>About</li>
        </ul>
        <ul class="list-inline">
            <li>SOAcial &copy; 2017</li>
        </ul>
    </div>

    <!-- Terms and Conditions -->
    <div class="modal fade" tabindex="-1" role="dialog" id="terms">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Terms and Conditions</h4>
                </div>
                <div class="modal-body">
                    <strong>We hold the right to terminate your account if found violating the terms below</strong>
                    <ul>
                        <li>Do not create account if you are not from any institute of SOA University.</li>
                        <li>Do not provide any false personal information while creating an account for yourself.</li>
                        <li>Do not create more than one personal account.</li>
                        <li>Do not misuse any information about any person you read.</li>
                        <li>Do not put pornographic photo as your profile picture.</li>
                        <li>Do not put abusive words in your personal information.</li>
                        <li>If you want to change or update your information that are unchangeable, kindly contact us.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Contact Us -->
    <div class="modal fade" tabindex="-1" role="dialog" id="contactUs">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{--<form id="contactForm" method="post" role="form" action="">--}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Contact Us</h4>
                    </div>
                    <div class="modal-body">
                        <strong>For any queries, Contact here:</strong>
                        <ul>
                            <li>champrohan123@gmail.com</li>
                            <li>+918895133161 (Whatsapp Only)</li>
                        </ul>

                        {{--<div class="form-group">
                            <label for="senderName" class="control-label">Full Name:</label>
                            <input type="text" name="senderName" class="form-control input-sm" id="senderName" required>
                        </div>
                        <div class="form-group">
                            <label for="senderEmail" class="control-label">Email id:</label>
                            <input type="text" name="senderEmail" class="form-control input-sm" id="senderEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="control-label">Subject:</label>
                            <input type="text" name="subject" class="form-control input-sm" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="messages" class="control-label">Message:</label>
                            <textarea name="messages" class="form-control input-sm" id="messages" required></textarea>
                        </div>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <img src="{{ asset('/img/ajax-loader.gif') }}" id="contactForm-loading-indicator" style="display:none">
                        <div id="contactform-alert">
                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        {{--<button type="submit" class="btn btn-primary" id="contactFormSubmitBtn" style="border-radius: 50px;">Send</button>--}}
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Close</button>
                    </div>
                {{--</form>--}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Privacy Policy -->
    <div class="modal fade" tabindex="-1" role="dialog" id="privacy">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Privacy Policy</h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Do not create password which is same in your other social accounts.</li>
                        <li>Do not accept/send friend request if you feel suspicious or doubtful.</li>
                        <li>Your personal information won't be shared or viewed unless you or the other person accepts the friend request.</li>
                        <li>For Register and Login, use your personal devices only.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- About Us -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="about">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">About Us</h4>
                </div>
                <div class="modal-body">
                    <strong>SOAcial</strong>, a social network platform for the students of SOA University, Bhubaneswar.
                    Here you can search anyone from any institute of any programme of any year and of any interests.
                    <br>
                    Siksha 'O' Anusandhan University has 9 institutes namely:
                    <ol>
                        <li>Institute of Technical Education and Research (ITER)</li>
                        <li>School of Hotel Management (SHM)</li>
                        <li>Institute of Business & Computer Studies (IBCS)</li>
                        <li>Sum Nursing College (SNC)</li>
                        <li>SOA National Institute of Law (SNIL)</li>
                        <li>School of Pharmaceutical Sciences (SPS)</li>
                        <li>Institute of Dental Sciences (IDS)</li>
                        <li>Institute of Medical Sciences & SUM Hospital (IMS & SUM)</li>
                        <li>Institute of Agriculture Sciences (IAS)</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Close</button>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>