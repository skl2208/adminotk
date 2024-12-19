$(function () {
    var pic = document.getElementById("fileToUpload");
    pic.addEventListener('change', () => {
        const file = pic.files;
        if (file) {
            const fileReader = new FileReader();
            const preview = document.getElementById('showPreviewPicture');
            fileReader.onload = event => {
                preview.setAttribute('src', event.target.result);
            }
            fileReader.readAsDataURL(file[0]);
        }
    });
});
