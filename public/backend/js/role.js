// delete brand
$(function() {
    // Assuming #publishButton is the ID of the button triggering the request
    $('.btn-delete-role').on('click', function(e) {
        e.preventDefault();
        const dataUrl = $(this).data("url");
        const parent = $(this).closest("tr");
        if (confirm("Bạn có muốn xóa vai trò này không?")) {
            $.ajax({
                type: 'DELETE',
                url: dataUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code === 200) {
                        parent.remove();
                        alert(response.message);
                    } else {
                        alert('Đã xảy ra lỗi!');
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert('Đã xảy ra lỗi!');
                }
            });
        }
    });
//checked all
$('.checked-all').on('click', function() {
    $(this).parents().find(".checkbox_children").prop('checked', $(this).prop("checked"));
});

})






