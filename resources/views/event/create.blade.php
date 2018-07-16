
@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Events</li>
            <li class="active active-title">Add a New Event</li>
        </ul>
    </div>
</div>

<div class="row">

    <form class="form-horizontal form-border" action="{{route('event.create')}}" method="post" autocomplete="off">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                        <div class="col-sm-3">
                            <h3 class="panel-title">{{$page_title}}</h3>
                        </div>
                        <div class="form-horizontal col-sm-9">
                            <label class="col-sm-3 control-label text-right">Year:</label>
                            <div class="col-sm-3">
                                <input type="number"  class="form-control border-none" style="background:none;padding-top:2px;" readonly id="year" name="year" value="">
                            </div>
                            <label class="col-sm-3 control-label text-right">Season:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control  border-none" style="background:none;padding-top:2px;" required readonly id="season" name="season">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Event Name*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="event_name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Start Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" required id="event_start_date" name="event_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Finish Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" required id="event_finish_date" name="event_finish_date">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event Level</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="event_level">
                                @foreach ($event_level_list as $event_level)
                                    <option value="{{$event_level->event_level_id}}">{{$event_level->event_level_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Event In UK</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="event_in_uk">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Event Manager*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="event_manager" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Event Deputy Mgr*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="event_deputy_mgr" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Lead Assessor*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="lead_assessor" value="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3 text-right">
                        <button class="btn btn-info">Save</button>
                        <input type="checkbox" id="toinfo" class="hidden" name="toinfo" value="1"/>
                        <button class="btn btn-info" onclick="toinfoclick()">Save & enter LJ Informtion</button>
                    </div>


                </div>
            </div>
        </div>
    </form>
</div>
@stop

@section('script')
<script>
    $(function () {
        $('#event_start_date').change(function () {
            var date = new Date($(this).val());
            var year = date.getFullYear();
            $('#year').val(year);
            $('#season').val(year + '-' + Number(year + 1));
        });

        var judges = [
                @foreach($judges as $judge)
        {value:'{{$judge->first_name.' '.$judge->sur_name}}', data: '{{$judge->judge_id}}_{{$judge->lj_number}}'},
                @endforeach
        ];
        $('input[name=event_manager], input[name=event_deputy_mgr], input[name=lead_assessor]').autocomplete({
            lookup: judges,
            onSelect: function (suggestion) {
                var data = suggestion.data;
                // var data = data.split('_');
                // $(this).next('.judge_id').val(data[0]);
                // $(this).parents('.form-group').find('.lj_number').val(data[1]);
    //                $(this).parents('.form-group').find('input[name=start_date]').focus().select();
            }
        });


    });

    function toinfoclick() {
        $('#toinfo').prop('checked', true);
    }
</script>
@stop