const successToast = (message) => {
    Toastify({
        text:  message,
        close: true,
        stopOnFocus: true,
        style: {
            'background' : '#33d460',
            'display' : 'flex',
        },
        position: 'center',
        gravity: 'top',
        offset: {
            'y' : 30
        }
    }).showToast();
}

const errorToast = (message) => {
    Toastify({
        text:  message,
        close: true,
        stopOnFocus: true,
        style: {
            'background' : '#eb1c1c',
            'display' : 'flex',
        },
        position: 'center',
        gravity: 'top',
        offset: {
            'y' : 30
        }
    }).showToast();
}

function addToCart(event, addToCartForm) {
    event.preventDefault();
    const formData = new FormData(addToCartForm);

    fetch(addToCartForm.action, {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
                successToast(data.message);
            }
            else {
                errorToast(data.message);
            }
        })
        .catch(err => {
            console.log(err);
        });
}