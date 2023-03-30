//like hoặc huỷ like truyện
let _token = $('input[name="_token"]').val()
function changeLikedComic(status, comicId) {
    $.ajax({
        url: '/thich-truyen',
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {status: status, comicId:comicId, _token: _token},
        success: function () {
            if (status == 'follow') {
                $('.follow-btn').css('display','none')
                $('.unfollow-btn').css('display','inline-block')
            } else {
                $('.follow-btn').css('display','inline-block')
                $('.unfollow-btn').css('display','none')
            }
        }
    })
}
