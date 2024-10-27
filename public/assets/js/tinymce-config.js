

  tinymce.init({
    selector: 'textarea#default',
    branding: false,
    promotion: false,
    plugins: ["lists","searchreplace", "table"], // Add the lists plugin
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
});

tinymce.init({
    selector: 'textarea#main',
    branding: false,
    promotion: false,
    plugins: ["lists","searchreplace", "table"], // Add the lists plugin
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
});




tinymce.init({
    selector: 'textarea#content',
    branding: false,
    promotion: false,
    plugins: ["image","lists","searchreplace", "table"],
     toolbar: 'undo redo |  image code| formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
    image_uploadtab: true,
    images_upload_handler: function (blobInfo, success, failure) {
        var formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        fetch('/admin/news/upload-image', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(result => {
            success(result.location);
        }).catch(error => {
            failure('Image upload failed');
        });
    }
});
