<div class="container">
    {{--<form method="get" id="searchForm" role="form" action="{{ route('searchResult') }}">
        <div class="row" style="display:flex;">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
                <input type="text" class="form-control" name="query" id="search" placeholder="Search Anyone :)" autocomplete="off" style="border-radius:50px" required>
            </div>
            <button class="fa fa-search fa-2x" aria-hidden="true" style="position:relative; margin-left: -70px; background-color: transparent; border-color: transparent"></button>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-4 col-xs-8 col-xs-offset-2">
                <button type="submit" class="btn btn-primary btn-block" id="searchBtn" style="border-radius:50px">Search</button>
                <br>
            </div>
            <div class="col-md-2 col-md-offset-0 col-xs-8 col-xs-offset-2">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#customSearch" style="border-radius:50px">Custom Search</button>
            </div>
        </div>
    </form>--}}
</div>

{{--
<script type="text/javascript">
    var path = "{{ route('searchProfile') }}";
    $('#search').typeahead({
        ajax: path,
        items: 20,
        valueField: 'id',
        displayField: 'full_name',
        scrollBar: true,
        autoSelect: false,
        alignWidth: true,
        onSelect: function () {
            $('#searchForm').change(function() {
                $('#searchForm').submit();
            });
        }
    });
</script>--}}
