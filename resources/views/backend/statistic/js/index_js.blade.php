<script type="text/javascript">
$(document).ready(function() {
    $('#statistic-menu a').addClass('active-menu');
    $("#first_date").datepicker( { maxDate: 0 });
    $("#end_date").datepicker( { maxDate: 0 });
    $("#first_date").change(function() {
        first_date = $(this).val();
        end_date = $("#end_date").val();
        if (end_date != '') {
            if (end_date < first_date) {
                alert('Please enter the dates correctly !');
                $("#first_date").val('');
            }
        }
    });
    $("#end_date").change(function() {
        end_date = $(this).val();
        first_date = $("#first_date").val();
        if (end_date < first_date) {
            alert('Please enter the dates correctly !');
            $("#end_date").val('');
        }
    });
    $(document).on('click','#filter_button',function() {
        first = $("#first_date").val();
        end = $("#end_date").val();
        if (first == '') {
            alert('Please enter the start date !');
        } else if (end == '') {
            alert('Please enter the end date !');
        } else {
            loadGraphicIncome();
            loadGraphicOutcome();
        }
    });
});

function loadGraphicIncome()
{
    $(function () {
        $.ajax({
            type:'post',
            url:"{{URL::to('admin/statistic/income')}}",
            data:{
                'type' : $("#type").val(),
                'first_date': $("#first_date").val(),
                'end_date'  : $("#end_date").val()
            },
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                if (obj.type == 'graphic') {
                    var myChart = Highcharts.chart('income', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Kissproof Income'
                        },
                        xAxis: {
                            categories: obj.date
                        },
                        yAxis: {
                            title: {
                                text: 'Nominal'
                            }
                        },
                        series: [{
                            name: 'Income',
                            data: obj.total
                        }]
                    });
                } else {
                    $('#income').html('');
                    $('#income').html(obj.table);
                }
            }
        });
    });
}

function loadGraphicOutcome()
{
    $(function () {
        $.ajax({
            type:'post',
            url:"{{URL::to('admin/statistic/outcome')}}",
            data:{
                'type' : $("#type").val(),
                'first_date': $("#first_date").val(),
                'end_date'  : $("#end_date").val()
            },
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                if (obj.type == 'graphic') {
                    var myChart = Highcharts.chart('outcome', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Kissproof Outcome'
                        },
                        xAxis: {
                            categories: obj.date
                        },
                        yAxis: {
                            title: {
                                text: 'Nominal'
                            }
                        },
                        series: [{
                            name: 'Outcome',
                            data: obj.total
                        }]
                    });
                } else {
                    $('#outcome').html('');
                    $('#outcome').html(obj.table);
                }
            }
        });
    });
}
</script>