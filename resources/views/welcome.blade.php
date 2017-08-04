@extends('template.layout')
@section('content')

    <div class="background">
        <div class="container">
            <div class="jumbotron text-center" style="margin-top:100px; opacity: 0.8;">
                <h1>SOAcial</h1>
                <p>The SOA Community</p>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="myModallogin" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><strong>Login </strong></h4></div>
                <div class="modal-body">
                    <div class="login-card">
                        <form id="loginForm" method="post" role="form" action="{{ route('login_user') }}">
                            <input class="form-control" type="text" placeholder="Email / Reg. No." autofocus="" name="login" required>
                            <input class="form-control" id="loginPassword" type="password" placeholder="Password" name="password" required>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="showLoginPassword"> Show Password
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember">Remember me</label>
                            </div>
                            <div id="recaptcha1" class="g-recaptcha"></div>
                            <img src="{{ asset('/img/ajax-loader.gif') }}" id="login-loading-indicator" style="display:none">
                            <hr>
                            <button class="btn btn-primary btn-block btn-signin" id="loginFormSubmitBtn" type="submit" style="border-radius:50px">Login </button><br>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        </form>
                        <a href="#" data-toggle="modal" data-target="#myModalpassword" class="forgot-password">Forgot your password?</a></div>
                    {{--<div id="login-form-success">
                    </div>
                    <div id="login-form-errors">
                    </div>--}}
                </div>
                {{--<div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>--}}
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="myModalregister" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="registerForm" role="form" method="post" action="{{ route('register_user') }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><strong>Register</strong> </h4>
                    </div>
                    <div class="modal-body">
                        {{--<form id="registerForm" role="form" method="post" action="{{ route('register_user') }}">--}}
                        <div class="form-group">
                            <label class="control-label">Registration No.</label>
                            <input class="form-control" type="text" name="regdno" data-toggle="tooltip" data-placement="top" title="Reg. number can't be changed later" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">First Name </label>
                            <input class="form-control" type="text" name="firstname" data-toggle="tooltip" data-placement="top" title="First Name can't be changed later" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name </label>
                            <input class="form-control" type="text" name="lastname" data-toggle="tooltip" data-placement="top" title="Last Name can't be changed later" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gender </label> <br>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="gender1" value="Female" checked>
                                Female
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="gender1" value="Male">
                                Male
                            </label>
                        </div>
                        <label class="control-label">Date of Birth:</label>
                        <div class="form-group">
                                <div class="form-group col-md-4">
                                    <label for="Day" class="control-label">Day:</label>
                                    <select class="form-control" name="day" id="Day" data-toggle="tooltip" data-placement="top" title="Date can't be changed later">
                                        <option hidden></option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>
                                        <option>31</option>
                                    </select>
                                </div>
                            <div class="form-group col-md-4">
                                <label for="Month" class="control-label">Month:</label>
                                <select class="form-control" name="month" id="Month" data-toggle="tooltip" data-placement="top" title="Month can't be changed later">
                                    <option hidden></option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Year" class="control-label">Year:</label>
                                <input type="text" class="form-control" name="year" id="Year" placeholder="YYYY">(optional)
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Institute </label>
                            <select class="form-control" name="institute" id="institute" data-toggle="tooltip" data-placement="top" title="Institute can't be changed later">
                                <option hidden></option>
                                @foreach($institutes as $institute)
                                    <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Programme</label>
                            <h6>(Select --Not Listed-- if Programme not available)</h6>
                            <select class="form-control" name="programme" id="programme" data-toggle="tooltip" data-placement="top" title="Programme can't be changed later">
                                <option value=""></option>
                            </select>
                        </div>
                        <label class="control-label">Academic Year:</label>
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label for="YearFrom" class="control-label">From:</label>
                                <input type="text" class="form-control" name="yearFrom" id="YearFrom" placeholder="YYYY" data-toggle="tooltip" data-placement="top" title="Year can't be changed later" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="YearTo" class="control-label">To:</label>
                                <input type="text" class="form-control" name="yearTo" id="YearTo" placeholder="YYYY" data-toggle="tooltip" data-placement="top" title="Year can't be changed later" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email Address</label>
                            <input class="form-control" type="email" name="email" title="Email" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password </label>
                            <input class="form-control" type="password" name="password" title="Password" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password </label>
                            <input class="form-control" type="password" name="confirm_password" title="Confirm Password" required>
                        </div>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="agreement"> I accept the Terms & Conditions and Privacy Policy
                            </label>
                        </div>
                        <div id="recaptcha2" class="g-recaptcha"></div>
                        <img src="{{ asset('/img/ajax-loader.gif') }}" id="register-loading-indicator" style="display:none">

                        <div id="register-form-success">
                        </div>
                    </div><!--modal-body-->
                    <div class="modal-footer">
                        <button class="btn btn-primary pull-left" id="registerFormSubmitBtn" disabled="disabled" type="submit" style="border-radius:50px">Submit</button>
                        <button class="btn btn-default" type="button" data-dismiss="modal" style="border-radius:50px">Close</button>
                    </div>
                </form>
            </div><!--modal-content-->
        </div><!--modal-dialog-->
    </div><!--modal-->

    <div class="modal fade" role="dialog" tabindex="-1" id="myModalpassword" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="passwordForm" role="form" method="post" action="{{ route('forgotPassword') }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><strong>Forgot Password</strong> </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Please provide your Email / Registration No.</label>
                            <input class="form-control" type="text" name="forgotPassword" title="Registration number" required placeholder="Email / Reg. No.">
                        </div>
                        {{--<div class="form-group">
                            <label class="control-label">Email </label>
                            <input class="form-control" type="text" name="pemail" title="Email" required>
                        </div>--}}

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <div id="recaptcha3" class="g-recaptcha"></div>
                        <img src="{{ asset('/img/ajax-loader.gif') }}" id="password-loading-indicator" style="display:none">

                        <div id="password-form-success">
                        </div>
                    </div><!--modal-body-->
                    <div class="modal-footer">
                        <button class="btn btn-primary pull-left" id="passwordFormSubmitBtn" type="submit" style="border-radius:50px">Submit</button>
                        <button class="btn btn-default pull-left" type="button" data-dismiss="modal" style="border-radius:50px">Close</button>
                    </div>
                </form>
            </div><!--modal-content-->
        </div><!--modal-dialog-->
    </div><!--modal-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#showLoginPassword').on('change',function(){
                var isChecked = $(this).prop('checked');
                if (isChecked) {
                    $('#loginPassword').attr('type','text');
                } else {
                    $('#loginPassword').attr('type','Password');
                }
            });

            $('#agreement').on('change',function(){
                var isChecked = $(this).prop('checked');
                if (isChecked) {
                    $('#registerFormSubmitBtn').removeAttr('disabled','disabled');
                }
                else {
                    $('#registerFormSubmitBtn').attr('disabled','disabled');
                }
            });
        });
    </script>
@endsection

