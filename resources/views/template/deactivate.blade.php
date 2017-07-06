@extends('template.layout')
@section('content')

    <div class="col-md-12">
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h2>Are you sure to <section>Deactivate</section> your account?</h2>
                <form action="{{ route('deactivateAccount',['regno' => Auth::user()->reg_no]) }}" method="post" id="deactivateAccount">
                    <input type="hidden" name="deactivate" value="{{ request()->input('deactivate') }}">
                    <button class="btn btn-danger" value="1">Yes</button>
                    <a class="btn btn-primary" href="{{ route('profile',['regno' => Auth::user()->reg_no]) }}">No</a>
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            var form = $('#deactivateAccount');

            $('.btn-danger').click(function () {
                var btn = $(this).attr("value");
                form.find('input[name="deactivate"]').val(btn);
                form.submit();

                $.notify({

                    // custom notification message
                    message: "Deactivating Please Wait..",

                    // 'default', 'info', 'error', 'warning', 'success'
                    status: "error",

                    // timeout in ms
                    timeout: 2000,

                    // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                    pos: 'top-center',

                    // z-index style for alert container
                    zIndex: 10400

                });
            });


        });
    </script>

@endsection