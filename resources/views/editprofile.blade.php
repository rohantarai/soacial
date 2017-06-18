@extends('template.layout')
@include('template.notifier')
@section('content')

<div id="bg" class="container">
    <form class="form-horizontal" id="editForm" role="form" method="post" action="{{ route('editProfile') }}">
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label class="col-md-2 control-label">Registration No:</label>
            <div class="col-md-3">
                <p class="form-control-static">{{ $users->reg_no }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Email ID:</label>
            <div class="col-md-3">
                <p class="form-control-static">{{ $users->email }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Account Since:</label>
            <div class="col-md-3">
                <p class="form-control-static">{{ date("d M Y - g:ia T",strtotime($users->created_at)) }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputFirstName" class="col-md-2 control-label">First Name:</label>
            <div class="col-md-3">
                <input type="text" value="{{ $users->first_name }}" class="form-control input-sm" name="inputFirstName" id="inputFirstName" placeholder="First Name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputLastName" class="col-md-2 control-label">Last Name:</label>
            <div class="col-md-3">
                <input type="text" value="{{ $users->last_name }}" class="form-control input-sm" name="inputLastName" id="inputLastName" placeholder="Last Name">
            </div>
        </div>
        <div class="row">
            <label for="inputYear1" class="col-md-2 col-sm-3 col-xs-12 control-label">Academic Year:</label>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="form-group">
                    <label for="inputYear1" class="col-md-3 control-label">From:</label>
                    <div class="col-md-6">
                        <input type="text" value="{{ $users->usersInfo->academicYear_from }}" class="form-control input-sm" name="inputYear1" id="inputYear1" placeholder="YYYY">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="form-group">
                    <label for="inputYear2" class="col-md-2 control-label">To:</label>
                    <div class="col-md-6">
                        <input type="text" value="{{ $users->usersInfo->academicYear_to }}" class="form-control input-sm"  name="inputYear2" id="inputYear2" placeholder="YYYY">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputHighSchool" class="col-md-2 control-label">High School:</label>
            <div class="col-md-6">
                <input type="text" value="{{ $users->usersInfo->high_school }}" class="form-control input-sm" name="inputHighSchool" id="inputHighSchool" placeholder="High School">
            </div>
        </div>
        <div class="form-group">
            <label for="inputCurrentCity" class="col-md-2 control-label">Current City:</label>
            <div class="col-md-3">
                <input type="text" value="{{ $users->usersInfo->current_city }}" class="form-control input-sm" name="inputCurrentCity" id="inputCurrentCity" placeholder="Current City">
            </div>
        </div>
        <div class="form-group">
            <label for="inputHometown" class="col-md-2 control-label">Hometown:</label>
            <div class="col-md-3">
                <input type="text" value="{{ $users->usersInfo->hometown }}" class="form-control input-sm" name="inputHometown" id="inputHometown" placeholder="Hometown">
            </div>
        </div>
        <div class="row">
            <label class="col-md-2 col-sm-3 col-xs-12 control-label">Date of Birth:</label>
            <div class="col-md-3 col-sm-2 col-xs-5">
                <div class="form-group">
                    <label for="inputDay" class="col-md-2 col-sm-2 control-label">Day:</label>
                    <div class="col-md-5 col-sm-10 col-xs-11">
                        <select class="form-control input-sm" name="inputDay" id="inputDay">
                            <option selected>{{ $users->usersInfo->born_day }}</option>
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
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-8">
                <div class="form-group">
                    <label for="inputMonth" class="col-md-3 control-label">Month:</label>
                    <div class="col-md-8">
                        <select class="form-control input-sm" name="inputMonth" id="inputMonth">
                            <option selected>{{ $users->usersInfo->born_month }}</option>
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
                </div>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-5">
                <div class="form-group">
                    <label for="inputYear" class="col-md-3 control-label">Year:</label>
                    <div class="col-md-5">
                        <input type="text" value="{{ $users->usersInfo->born_year }}" class="form-control input-sm" name="inputYear" id="inputYear" placeholder="YYYY">(optional)
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputRelationshipStatus" class="col-md-2 control-label">Relationship Status:</label>
            <div class="col-md-3">
                <select class="form-control input-sm" name="inputRelationshipStatus" id="inputRelationshipStatus">
                    <option selected disabled>{{ $users->usersInfo->relationship }}</option> <i class="fa fa-check" aria-hidden="true"></i>
                    <option>Single</option>
                    <option>Forever Single</option>
                    <option>In Relationship</option>
                    <option>In Long-Distance Relationship</option>
                    <option>Its Complicated</option>
                    <option>Confidential</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputQuotes" class="col-md-2 control-label">Favourite Quotes:</label>
            <div class="col-md-6">
                <textarea class="form-control" name="inputQuotes" id="inputQuotes" rows="3" placeholder="">{{ $users->usersInfo->quotes }}</textarea>
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> <small>To create a new line, put &lt;br&gt; tag at the end of each line</small><br></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputInterests" class="col-md-2 control-label">Interests:</label>
            <div class="col-md-6">
                {{--<input multiple type="text" class="form-control" data-url="{{ asset('/interests.json') }}" name="inputInterests" id="inputInterests" placeholder="Choose Interests">--}}
                <select class="form-control" multiple="multiple" name="inputInterests[]" id="inputInterests">
                    @foreach($interests as $interest)
                        <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAchievements" class="col-md-2 control-label">Achievements:</label>
            <div class="col-md-6">
                <textarea class="form-control" name="inputAchievements" id="inputAchievements" rows="2" placeholder="">{{ $users->usersInfo->achievements }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAboutMe" class="col-md-2 control-label">About Me:</label>
            <div class="col-md-6">
                <textarea class="form-control" name="inputAboutMe" id="inputAboutMe" rows="5" placeholder="">{{ $users->usersInfo->about }}</textarea>
                <span>
                    <i class="fa fa-info-circle" aria-hidden="true"></i> <small>To make the text <strong>bold</strong>, put the text in between &lt;strong&gt; &lt;/strong&gt; tag</small>
                </span>
            </div>
        </div>
        <hr>
        <h3><strong>Other Social Networks</strong></h3>
        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> Only <strong>username</strong> or <strong>userid</strong> is <strong>required</strong><br>
        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> If you do not have any of these accounts then keep it blank<br>
        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> If you do not want to share your soacial accounts then keep it blank<br><br>
         <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-facebook-square fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->facebook }}" class="form-control" name="Facebook" id="inputFacebook" placeholder="Facebook">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>www.facebook.com/<mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-google-plus-square fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->googleplus }}" class="form-control" name="GooglePlus" id="inputGooglePlus" placeholder="Google+">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>plus.google.com/u/0/<mark>userid</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-instagram fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->instagram }}" class="form-control" name="Instagram" id="inputInstagram" placeholder="Instagram">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>www.instagram.com/<mark>username</mark>/</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-linkedin-square fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->linkedIn }}" class="form-control" name="LinkedIn" id="inputLinkedIn" placeholder="LinkedIn">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>in.linkedin.com/in/<mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-skype fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->skype }}" class="form-control" name="Skype" id="inputSkype" placeholder="Skype">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>Enter your Skype Login <mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-snapchat-square fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->snapchat }}" class="form-control" name="Snapchat" id="inputSnapchat" placeholder="Snapchat">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>Enter your Snapchat <mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-telegram fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->telegram }}" class="form-control" name="Telegram" id="inputTelegram" placeholder="Telegram">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>Enter your Telegram <mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-twitter-square fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->twitter }}" class="form-control" name="Twitter" id="inputTwitter" placeholder="Twitter">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>www.twitter.com/<mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-whatsapp fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->whatsapp }}" class="form-control" name="Whatsapp" id="inputWhatsapp" placeholder="Whatsapp">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>(Optional) Enter your Phone Number with +91</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-youtube-square fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->youtube }}" class="form-control" name="Youtube" id="inputYoutube" placeholder="Youtube">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>www.youtube.com/<mark>user/username</mark> <strong>OR</strong> www.youtube.com/<mark>channel/channelname</mark></small>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fa fa-quora fa-3x pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{ $users->usersInfo->quora }}" class="form-control" name="Quora" id="inputQuora" placeholder="Quora">
                    </div>
                    <div>
                        <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i> <small>www.quora.com/profile/<mark>username</mark></small>
                    </div>
                </div>
            </div>
        </div>--}}
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
        <img src="{{ asset('/img/ajax-loader.gif') }}" id="edit-loading-indicator" style="display:none">
        <button class="btn btn-primary btn-block" type="submit" id="editFormSubmit" style="border-radius:50px">Submit</button>
        {{--<div id="edit-form-success">
        </div>--}}
    </form>
</div>
<script>
    $(document).ready(function() {
        var input = $('#inputInterests');
        input.select2().val({{ json_encode($users->interests()->getRelatedIds()) }}).trigger("change");
        input.select2({
            placeholder: "Choose Interests",
            closeOnSelect: false
        });
    });
</script>
@endsection