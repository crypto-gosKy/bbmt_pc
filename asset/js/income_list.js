/**
 * Created by wangliang on 16/5/2.
 */

$(function() {
    var page = 1;

    /**
     * 获取收入数据
     * @param int type
     */
    function getIncome() {
        var param = {};

        param['begin_date'] = $('#begin_date').val();
        param['end_date']   = $('#end_date').val();
        param['page']       = page;

        //判断时差
        if(moment(param['begin_date']).isAfter(param['end_date'])) {
            alert('开始时间必须要小于结束时间');

            return false;
        }

        $.ajax({
            type: 'GET',
            url: '/index.php/shops/income',
            data:  param,
            dataType: 'json',
            success: function(data) {
                var html = template('income_tpl', {
                    'list': data['income_list']
                });

                $('#shopIncomeTable tbody').html(html);

                //更新分页
                $('.pagination span, .pagination a').remove();
                $('.pagination').prepend(data['page']);
                $('#total_page').html(data['total_page']);
                $('#total_count').html(data['total_count']);
                $('#cur_page').val(data['cur_page']);
            }
        });
    }

    // 点击分页事件
    //分页处理
    $('#pagination').delegate('a, input[type="button"]', 'click', function() {
        page = parseInt($(this).attr('data-ci-pagination-page'));

        if($(this).is('input')) {
            page = parseInt($('#cur_page').val());
        }

        getIncome();

        return false;
    });

    // 点击Tab切换
    $('#statusSearch').delegate('a', 'click', function() {
        var data_status = $(this).attr('data-status');
        $('#statusSearch a').removeClass('active');
        $(this).addClass('active');

        //data_status == 1 昨天
        if(data_status == 1) {
            page = 1;
            $('#begin_date').val(moment().subtract(1, 'd').format('YYYY-MM-DD'));
            $('#end_date').val(moment().format('YYYY-MM-DD'));
            getIncome();
        }

        //data_status == 2 近七天
        if(data_status == 2) {
            page  = 1;
            $('#begin_date').val(moment().subtract(7, 'd').format('YYYY-MM-DD'));
            $('#end_date').val(moment().format('YYYY-MM-DD'));
            getIncome();
        }

        //data_status == 3 近30天
        if(data_status == 3) {
            page = 1;
            $('#begin_date').val(moment().subtract(30, 'd').format('YYYY-MM-DD'));
            $('#end_date').val(moment().format('YYYY-MM-DD'));
            getIncome();
        }
    });

    // 点击搜索事件
    $('body').delegate('#searchBtn', 'click', function() {
        page = 1;
        getIncome();
    });
});
