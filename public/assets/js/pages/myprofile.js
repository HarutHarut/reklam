$(function () {
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);

    $('.circle-progress > div').circleProgress({
        size: 86,
        lineCap: 'round',
        fill: '#EFA00B',
        startAngle: -1.55,
        emptyFill: 'rgba(0,0,0,0)'
    });

    $('body').on('change', '.select-all input[type="checkbox"]', function () {
        $('#' + $(this).attr('name')).find('input[type="checkbox"]').prop('checked', $(this)[0].checked);
    });

    $('.myLists input').change(function () {

        let newUrl = window.location.origin + window.location.pathname;

        let filter = [];
        $('.myLists input').each(function () {
            if ($(this).is(':checked')) {
                filter.push($(this).val());
            }
        })
        $.ajax({
            url: "/profile/filter?filter=" + filter,
            method: 'GET',
            success: function (response) {
                let listingStatus = JSON.parse(response).listingStatus;
                $('.myLists input[value=' + listingStatus + ']').attr('selected');
                $('#result').empty().html(JSON.parse(response).renderInformation);
                $("#statusFilter").val(listingStatus);
                if(listingStatus == 'active'){
                    window.location.href = newUrl;
                }

            }
        });
    })

    $(window).keyup(function(e){
        var target = $('.checkbox-ios input:focus');
        if (e.keyCode == 9 && $(target).length){
            $(target).parent().addClass('focused');
        }
    });

    $('.checkbox-ios input').focusout(function(){
        $(this).parent().removeClass('focused');
    });

    // var $shareContainer = $('.overlay.share');
    // $('#post-share-btn').click(function () {
    //     $shareContainer.show();
    //     $shareContainer.off().on('mouseleave', function () {
    //         $(this).hide();
    //     });
    // });

    $(document).delegate('.update-listing', 'click', function (e) {
        e.preventDefault();
        let formData = new FormData();
        let form = $('#edit-post-frm input, #edit-post-frm textarea');
        let formSelect = $('#edit-post-frm select');
        let checkedArr = [];
        let files = $('input[type="file"]');

        if(files[0].files.length !== 0){
            for(let j = 0; j < uploadedFiles.length; j++) {
                formData.append("imgs[" + j + "]", files[0].files[j])
            }
        }
        formData.append("deleteItems", JSON.stringify(deleteItems))


        for(let i = 0; i < form.length - 1; i++){
            let name = form.eq(i).attr('name');

            if (form.eq(i).attr('type') == 'checkbox'){
                $('#edit-post-frm input[name="'+ name +'"]:checked').each(function () {
                    checkedArr.push($(this).val());
                })
                formData.append(form.eq(i).attr('name'),  checkedArr.length ? JSON.stringify(checkedArr) : '');
                checkedArr = [];
            }
            else if(form.eq(i).attr('type') == 'radio'){
                formData.append(form.eq(i).attr('name'), $('#edit-post-frm input[name='+ name +']:checked').val() ? $('#edit-post-frm input[name='+ name +']:checked').val() : '');
            }
            else{
                formData.append(form.eq(i).attr('name'), form.eq(i).val());
            }
        }
        for(let i = 0; i < formSelect.length; i++){
            formData.append(formSelect.eq(i).attr('name'), formSelect.eq(i).val());
        }
        formData.append('present', JSON.stringify(present));

        $.ajax({
            url: "profile/listing/update",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#message_text').removeClass('danger');
                $('#message_text').addClass('success');
                $('#message_text').empty().html(response.message)
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: (data) => {
                $('.error-msg').css({display: 'none'});
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error_' + index).css({color: 'red', display: 'block'});
                    $('.below_' + index).css({display: 'none'});
                });
            },
        });
    })

    var listFile = null

    $(document).on('click', '.rem-btn', function () {
        if (listFile == null) {
            listFile = Array.from(jQuery('input[type="file"]')[0].files);
        }
        listFile.splice(parseInt(jQuery(this).parents('.img-thmb').attr('data-index')), 1);
    })

    $('#my-listings').change(function () {
        // let sort = $(this).val();
        // let status = $('.myLists input[checked]').val();
        // $.ajax({
        //     url: "profile?sort=" + sort + '&status=' + status,
        //     method: 'GET',
        //     success: function (response) {
        //         // $('#result').empty().html(response);
        //     }
        // }).then(function (data) {
        //     // let errorJson = JSON.parse(response.responseText);
        //     // $.each(errorJson.errors, (index, value) => {
        //     //     $('.error_' + index).text(value);
        //     // });
        // });
        // console.log(sort, 'status')
        $('#my_listings_form').submit();
    });


    // $('#post-share-btn').click(function () {
    //
    // });


});

function editProfile(userId) {
    $.ajax({
        url: "/profile/edit/" + userId,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('.edit_bio').addClass('active');
            $('#result').empty().html(response);
        }
    });
}

function editPassword(userId) {
    $.ajax({
        url: "/profile/edit-password/" + userId,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('.edit_bio').addClass('active');
            $('#result').empty().html(response);
        }
    });
}

function upgrade() {
    $.ajax({
        url: "/profile/upgrade",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('.upgrade').addClass('active');
            $('#result').empty().html(response);
        }
    });
}

function prolong() {
    $.ajax({
        url: "/profile/prolong",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function (response) {
            $('.prolong').addClass('active');
            $('#result').empty().html(response);
        }
    });
}

function openDeleteModal(listing_id) {
    $('#delete-form-listing').attr('action', 'profile/delete-listing/' + listing_id)
    $('#delete-form').addClass('open');
}

function openChangeStatusModal(listing_id) {
    $('#update-form-listing').attr('action', 'profile/listing/change-status/' + listing_id)
    $('#update-form').addClass('open');
}



function editListing(listing_id) {
    $.ajax({
        url: "profile/edit-listing/" + listing_id,
        method: 'GET',
        success: function (response) {
            $('#result').empty().html(response);
        }
    }).then(function (data) {
        // let errorJson = JSON.parse(response.responseText);
        // $.each(errorJson.errors, (index, value) => {
        //     $('.error_' + index).text(value);
        // });
    });
}

function openDeleteManyModal() {
    $('#delete-form-many').addClass('open');
}

function prologon30(listingId) {
    $.ajax({
        url: "/profile/listing/prologon-30/" + listingId,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            alert(response);
        }
    });
}
function prologon7(listingId) {
    $.ajax({
        url: "/profile/listing/prologon-7/" + listingId,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            alert(response);
        }
    });
}
