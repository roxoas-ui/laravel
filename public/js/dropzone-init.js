Dropzone.autoDiscover = false;

document.addEventListener('DOMContentLoaded', function () {
    const dz = new Dropzone('#documents-dropzone', {
        paramName: 'file',
        maxFilesize: 20, // MB
        acceptedFiles: '.pdf,.jpg,.jpeg,.png',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        init: function () {
            this.on('success', function (file, response) {
                console.log('Upload OK', response);
            });
            this.on('error', function (file, err) {
                console.error('Upload error', err);
            });
        }
    });
});