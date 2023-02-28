$(document).ready(function () {
    callAjax();

    $('.reset-search').click(function () {
        $('.admin-search').val('');
        callAjax();
    })

    $('.admin-search').on('keyup', function () {
        let keyword = $(this).val();
        setTimeout(function () {
            callAjax(keyword)
        }, 1000)
    })

    function callAjax(keyword = '') {
        let _token = $('input[name="_token"]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            method: 'post',
            url: "/admin/category/search",
            dataType: 'html',
            data: {
                keyword: keyword,
                _token: _token
            },
            beforeSend: function () {
                $('tbody').html('<td colspan="3">Loading...</td>')
            },
            success: function (res) {
                $('.ajax-response').html(res)
            }
        });
    }
})
