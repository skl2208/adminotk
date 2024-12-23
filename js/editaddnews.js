
$(function () {

    //================== ดึงข้อมูลจากฐานข้อมูล =================//
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    console.log(id);
    //================== ดึงข้อมูลจากฐานข้อมูล =================//
    if (id != "") {
        var url = "ws/news/shownews_ws.php?id=" + id;
        console.log("url = " + url);
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success: function (data) {
                var filename = data.data[0].imageurl;
                if (filename == "") {
                    filename = data.data[0].imagename;
                }
                console.log(data.data[0].imageurl);
                console.log(data.data[0].imagename);
                //===== ทำการ bind ค่าลงในหน้าเวป =====//
                $("#id").val(data.data[0].id);
                $("#headnews").val(data.data[0].headnews);
                $("#headimageurl").val(data.data[0].headimageurl);
                // $("#content").val(data.data[0].content);
                CKEDITOR.instances['content'].setData(data.data[0].content);

                $("#status").val(data.data[0].status);

                if (data.data[0].status == 'T') {
                    $("#status").prop("checked", true);
                } else {
                    $("#status").prop("checked", false);
                }

                $("#showpicture").attr("src", data.data[0].headimageurl);

            }
        });
    } else {
        console.log("new record");
    }




});

function enterimageurl() {
    $("#imageurl").removeClass("hidden");
}
function callfromalbum() {
    $("#imageurl").addClass("hidden");
}
function openAlbum(href) {
    window.open(href, 'album', 'adressbar=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1200,height=700');
    return false;
}


