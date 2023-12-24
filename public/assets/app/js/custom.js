

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

const warningToast = (message) => {
    Toastify({
        text:  message,
        close: true,
        stopOnFocus: true,
        style: {
            'background' : '#e6c212',
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