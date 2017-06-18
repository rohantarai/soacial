@extends('template.layout')
@include('template.notifier')
@section('content')

    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <form id="changePasswordForm" class="form-horizontal" action="{{ route('changePassword') }}" method="post">
                    <input name="_method" type="hidden" value="PUT">
                    <div class="form-group">
                        <label for="InputCurrentPassword">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword" id="InputCurrentPassword" placeholder="Current Password" required>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="showCurrentPassword"> Show Password
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputNewPassword">New Password</label>
                        <input type="password" class="form-control" name="newPassword" id="InputNewPassword" placeholder="New Password" required>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="showNewPassword"> Show Password
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputConfirmNewPassword">Confirm New Password</label>
                        <input type="password" class="form-control" name="confirmNewPassword" id="InputConfirmNewPassword" placeholder="Confirm New Password" required>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="showConfirmNewPassword"> Show Password
                            </label>
                        </div>
                    </div>
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    <button class="btn btn-primary" type="submit" id="changePasswordSubmitBtn" style="border-radius:50px">Update</button>
                    <img src="{{ asset('/img/ajax-loader.gif') }}" id="changePassword-loading-indicator" style="display:none">
                </form>
            </div>
            <br>
            <div id="passwordChangeAlert" role="alert"></div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#showCurrentPassword').on('change',function(){
                var isChecked = $(this).prop('checked');
                if (isChecked) {
                    $('#InputCurrentPassword').attr('type','text');
                } else {
                    $('#InputCurrentPassword').attr('type','Password');
                }
            });

            $('#showNewPassword').on('change',function(){
                var isChecked = $(this).prop('checked');
                if (isChecked) {
                    $('#InputNewPassword').attr('type','text');
                } else {
                    $('#InputNewPassword').attr('type','Password');
                }
            });

            $('#showConfirmNewPassword').on('change',function(){
                var isChecked = $(this).prop('checked');
                if (isChecked) {
                    $('#InputConfirmNewPassword').attr('type','text');
                } else {
                    $('#InputConfirmNewPassword').attr('type','Password');
                }
            });
        });
    </script>

@endsection