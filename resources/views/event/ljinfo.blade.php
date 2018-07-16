
@extends('master')
@section('content')

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<div class="form-group has-error">
    <div class="col-md-12">
        <div class="alert alert-info"><button data-dismiss="alert" class="close">&times;</button>{{ $error }}</div>
    </div>
</div>
@endforeach
@endif
<div class="row">
    <div class="col-md-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li>Events</li>
            <li class="active active-title">Add LJs to Events</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$page_title}}</h3>
            </div>
            <div class="panel-body">
                <form id="ljinfo-form" class="form-horizontal form-border" action="{{route('event.ljinfo.update')}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" id="event_id" name="event_id"/>
                    <div class="form-group">
                        <label class="col-sm-1 control-label" >Event*</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" required name="event_name" value="">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" required readonly id="event_number" name="event_number" value="" placeholder="Event Number">
                        </div>                        
                        <div class="col-sm-3">
                            <input type="text" class="form-control" required readonly id="season" name="season" value="" placeholder="Season">
                        </div>
                            <input type="hidden" class="form-control" required readonly id="event_start_date" name="event_start_date" value="">
                            <input type="hidden" class="form-control" required readonly id="event_finish_date" name="event_finish_date" value="">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: left;">Line Judges</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-1 control-label" style="text-align: center">Name</label>
                        <label class="col-sm-2 control-label" style="text-align: center">Number</label>
                        <label class="col-sm-3 control-label" style="text-align: center">Start Date</label>
                        <label class="col-sm-3 control-label" style="text-align: center">End Date</label>
                    </div>
                    <section class="info_section">
                        @for($i=0; $i < 12; $i++)
                        <div class="form-group lj{{$i}}">
                            <label class="col-sm-1 control-label">{{$i+1}}</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control lj_name" name="judge_name">
                                <input type="hidden" class="judge_id" name="judge_id[]"/>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control lj_number" readonly="" name="lj_number[]">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control datepicker start_date" name="start_date[]">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control datepicker finish_date" name="finish_date[]">
                            </div>
                        </div>
                        @endfor
                    </section>

                    <div class="col-sm-6 col-sm-offset-3 text-center" >
                        <button class="btn btn-info">Save</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    $(function () {
    $('.start_date').change(function () {
    var start_date = $('.start_date').val().split('/');
    start_date = start_date[1] + '/' + start_date[0] + '/' + start_date[2];
    $(this).parent().next().find('.finish_date').datepicker('setStartDate', $(this).val());
    $(this).parent().next().find('.finish_date').datepicker('setDate', $(this).val());
    });
    var countries = [
            @foreach($events as $event)
    {value:'{{$event->event_name}}', data: '{{$event->event_id}}_E{{substr($event->year, 2) . $event->event_number}}_{{$event->season}}_{{$event->event_start_date}}_{{$event->event_finish_date}}'},
            @endforeach
    ];
    $('input[name=event_name]').autocomplete({
    lookup: countries,
            onSelect: function (suggestion) {
            var data = suggestion.data;
            var data = data.split('_');
            $('#event_id').val(data[0]);
            $('input[name=event_number]').val(data[1]);
            $('input[name=season]').val(data[2]);
            $('input[name=event_start_date]').val(data[3]);
            $('.start_date').datepicker('setStartDate', moment(data[3]).format('DD/MM/YYYY'));
            $('.start_date').datepicker('setEndDate', moment(data[4]).format('DD/MM/YYYY'));
            $('input[name=event_finish_date]').val(data[4]);
            $('.finish_date').datepicker('setStartDate', moment(data[3]).format('DD/MM/YYYY'));
            $('.finish_date').datepicker('setEndDate', moment(data[4]).format('DD/MM/YYYY'));
            $.ajax({
            type: "get",
                    url: '{{route('event.ljinfo.get')}}',
                    data:{event_id: data[0]},
                    error: function (req, text, error) {
                    },
                    success: function (data) {
                    $('.info_section').find('input').each(function(){
                    $(this).val('');
                    });
                    for (var i = 0; i < data.length; i++){
                    $('.lj' + i).find('.judge_id').val(data[i]['judge_id']);
                    $('.lj' + i).find('.lj_name').val(data[i]['first_name'] + ' ' + data[i]['sur_name']);
                    $('.lj' + i).find('.lj_number').val('LJ' + (data[i]['judge_id'] < 10?'00' + data[i]['judge_id']:(data[i]['judge_id'] < 100?'0' + data[i]['judge_id']:data[i]['judge_id'])));
                    $('.lj' + i).find('.start_date').val(data[i]['start_date']);
                    $('.lj' + i).find('.finish_date').val(data[i]['finish_date']);
                    }
                    },
                    dataType: "json"
            });
            }
    });
    var judges = [
            @foreach($judges as $judge)
    {value:'{{$judge->first_name.' '.$judge->sur_name}}', data: '{{$judge->judge_id}}_{{$judge->lj_number}}'},
            @endforeach
    ];
    $('.lj_name').autocomplete({
    lookup: judges,
            onSelect: function (suggestion) {
            var data = suggestion.data;
            var data = data.split('_');
            $(this).next('.judge_id').val(data[0]);
            $(this).parents('.form-group').find('.lj_number').val(data[1]);
//                $(this).parents('.form-group').find('input[name=start_date]').focus().select();
            }
    });

    $('#ljinfo-form').submit(function(e){
        
        event_first_date = $('#event_start_date').val();
        event_finish_date = $('#event_finish_date').val();
        
        is_ranged = true;
        $('.start_date').each(
            function(index, element) {
                $(element).next('p').remove();
                current_date = $(element).val();
                if(current_date!=''){
                    var a = moment(event_first_date);
                    var b = moment(current_date);
                    console.log(a.diff(b, 'days')); 
                    first_date_diff = a.diff(b, 'days');
                    if(first_date_diff<0){
                        is_ranged = false;
                        $(element).after('<p style="color:red">Date should be in range of Event period</p>');
                    }
                }
        });

        if(!is_ranged){
            e.preventDefault();
            alert('Date should be in range of Event period.');
        }
    });

    });
</script>
@stop