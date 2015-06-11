$(function(){
    $(document).on('click', '.sidebox h2', function () {
        if ($(this).parent('.sidebox').hasClass('hover')) {
            $(this).parent('.sidebox').removeClass('hover');
        } else {
            $(this).parent('.sidebox').addClass('hover');
        }
    });
    $(document).on('click', '.acHref', function () {
        if ($(this).hasClass('hover') === false) {
            $('.acHref').removeClass('hover');
            $(this).addClass('hover');
        }
    });
    $(document).on('mouseleave', '.sidebar', function () {
        $('.acHref').removeClass('hover');
        $('.sidebox.select').addClass('hover');
        $('.acHref.select').addClass('hover');
        $('.acHref acHrefSmall.select').addClass('hover');
    });
    //多圖片上傳自動新增上傳按鈕
    $(document).on('change', '[fanswoo-fileMultiple]', function(){
        if($(this).find(":file").val() !== '')
        {
            if($(this).parent('.spanLineLeft').find("[fanswoo-fileMultiple] :file[value='']").size() === 0)
            {
                $(this).clone().val('').insertAfter(this).parent('.spanLineLeft').find('[fanswoo-fileMultiple]:last');
            }
        }
        else
        {
            $(this).remove();
        }
    });
    //刪除圖片
    $(document).on('click', '[fanswoo-picDelete]', function(){
        var picid = $(this).parent('[fanswoo-picid]').attr('fanswoo-picid');
        $.ajax({
            url: 'ajax/pic/delete_pic/picid/' + picid,
            error: function(xhr){},
            success: function(response){
                $('[fanswoo-picid=' + picid + ']').remove();
                alert('刪除成功');
            }
        });
    });
});