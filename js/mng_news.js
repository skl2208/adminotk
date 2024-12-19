
$(function () {
    //================== ดึงข้อมูลจากฐานข้อมูล =================//
    var url = "ws/news/showallnews_ws.php";
    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            var jsonData = JSON.parse(data);
            var myData = jsonData.data;
            //===== ทำการ bind ค่าลงในหน้าเวป =====//
            var html = "";
            for (var i = 0; i < myData.length; i++) {
                console.log(myData[i].status);
                html += '<div class="col-1 text-end">' + myData[i].id + '</div>';
                html += '<div class="col-5 text-start">' + myData[i].headnews + '</div>';
                html += '<div class="col-3 text-start d-block" style="overflow:hidden;text-overflow:ellipsis;"><img src="'+myData[i].headimageurl+'" style="max-width:100%;height:100px"></div>';
                html += '<div class="col-2 text-start">' + (myData[i].status == 'T' ? 'กำลังใช้งาน':'งดใช้งาน') + '</div>';
                html += '<div class="col-1 text-center"><button class="btn-small btn-save" onclick="window.location.href=\'editaddnews.php?id=' + myData[i].id + '\'">แก้ไข</button> <button class="btn-small btn-cancel" onclick="javascript:deletenews('+myData[i].id+')">ลบ</div>';
                html += "<div class=\"col-12\"><hr></div>";
            }
            $("#showallnews").append(html);

        }
    });
});

function deletenews(id) {
    if(confirm('คุณกำลังลบ '+id+ ' กรุณายืนยันการลบ')) {
        var url = "ws/news/deletenews_ws.php";
        var dataInput = "{\"id\" : "+id+"}";
        $.ajax({
            url: url,
            method: "POST",
            data: JSON.parse(dataInput) ,
            success: function (data) {
                window.location.href = "mng_news.php";
    
            },
            error: function(data) {
                alert("Cannot delete !");
            }
        });
    }
}