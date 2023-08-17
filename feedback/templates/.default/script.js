let formElement = document.getElementById('form-tailwind')
formElement.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(formElement);
    BX.ajax.runComponentAction('osminojka:feedback',
        'sendMessage', {
            mode: 'class',
            data: {
                fields: {
                    name: formData.get('name'),
                    email: formData.get('email'),
                    phone: formData.get('phone'),
                    message: formData.get('message'),
                    files: formData.getAll('images[]'),
                }
            },
        })
        .then(function (response) {
            if (response.status === 'success') {
                console.log(response);
            }
        }).catch(function (response) {
        console.log(response);
    });
});

