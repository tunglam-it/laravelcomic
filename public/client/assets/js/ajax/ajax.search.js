$(document).ready(function () {

    //sau khi nhập vào đc 1s mới gọi ajax
    let timeout = null;
    let form = $('#form-ajax');
    let btnSearch = $('#btnSearch');
    let _token = $('input[name="_token"]').val()

    disallowSubmitForm();

    //chặn enter và submit form
    function disallowSubmitForm() {
        btnSearch.attr('disabled', true);
        form.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        })
    }

    //cho phep submit form
    function allowSubmitForm() {
        btnSearch.attr('disabled', false);
        form.on('keydown', function (e) {
            if (e.keyCode === 13) {
                form.submit();
            }
        })
    }

    //goi ajax
    function callSearchAjax(keyword) {
        $.ajax({
            url: '/tim-kiem',
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'html',
            data: {keyword: keyword, _token:_token},
            success: function (response) {
                $('#search-result').html(response)
                $('#list-result-ajax').removeClass('ajax-unactive')
            }
        })
    }

    //sau nhập 0.5s mới gọi ajax
    $('#search_box').on('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            let keyword = $('#search_box').val()
            if (keyword !== '' && keyword !== null) {
                callSearchAjax(keyword)
                allowSubmitForm()
            } else {
                disallowSubmitForm()
            }
        }, 500)
    })

    //bấm ra ngoài ô search sẽ ẩn kết quả
    $(document).click(function (e) {
        var target = e.target;
        if (!$(target).is('#form-ajax') && !$(target).parents().is('#form-ajax')) {
            $('#list-result-ajax').addClass('ajax-unactive')
        }
    })
})
