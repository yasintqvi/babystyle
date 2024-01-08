const successToast = (message) => {
    Toastify({
        text: message,
        close: true,
        stopOnFocus: true,
        style: {
            'background': '#33d460',
            'display': 'flex',
        },
        position: 'center',
        gravity: 'top',
        offset: {
            'y': 30
        }
    }).showToast();
}

const errorToast = (message) => {
    Toastify({
        text: message,
        close: true,
        stopOnFocus: true,
        style: {
            'background': '#eb1c1c',
            'display': 'flex',
        },
        position: 'center',
        gravity: 'top',
        offset: {
            'y': 30
        }
    }).showToast();
}

class ShoppingCart {
    addToCart(addToCartForm) {
        const formData = new FormData(addToCartForm);

        fetch(addToCartForm.action, {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.statusCode === 201) {
                        this.#updateShoppingCartItemCount();
                    }
                    successToast(data.message);
                }
                else if (data.redirect) {
                    errorToast('برای اضافه کردن محصول به سبد خرید ابتدا وارد حساب کاربری خود شوید.');
                    setTimeout(() => {
                        successToast('در حال انتقال به صفحه ورود ...');
                        window.location.href = data.redirect;
                    }, 2000);
                }
                else {
                    errorToast(data.message);
                }
            })
            .catch(err => {
                console.log(err);
            });
    }

    #updateShoppingCartItemCount() {
        const shoppingCartItemCountEle = document.querySelector('#shopping_items_count');
        shoppingCartItemCountEle.textContent = parseInt(shoppingCartItemCountEle.textContent) + 1;
    }

    changeQuantity(quantityForm) {
        
        const formData = new FormData(quantityForm);

        fetch(quantityForm.action, {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.statusCode === 201) {
                        this.#updateShoppingCartItemCount();
                    }
                    successToast(data.message);
                } else if (data.redirect) {
                    errorToast('برای اضافه کردن محصول به سبد خرید ابتدا وارد حساب کاربری خود شوید.');
                    setTimeout(() => {
                        successToast('در حال انتقال به صفحه ورود ...');
                        window.location.href = data.redirect;
                    }, 2000);
                } else {
                    errorToast(data.message);
                }
            })
            .catch(err => {
                console.log(err);
            });
    }
}