const successAlert = (message) => {
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

const errorAlert = (message) => {
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

const formatMoney = (money) => {
    const regex = /(\d)(?=(\d{3})+$)/g;
    return money.toString().replace(regex, '$1,');
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
                    successAlert(data.message);
                }
                else if (data.redirect) {
                    errorAlert('برای اضافه کردن محصول به سبد خرید ابتدا وارد حساب کاربری خود شوید.');
                    setTimeout(() => {
                        successAlert('در حال انتقال به صفحه ورود ...');
                        window.location.href = data.redirect;
                    }, 2000);
                }
                else {
                    errorAlert(data.message);
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

    changeQuantity(quantityForm, qtyAction) {
        const formData = new FormData(quantityForm);
        
        formData.append('action', qtyAction);

        fetch(quantityForm.action, {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    const productPriceEle = quantityForm.querySelector('.product-price-unit');
                    quantityForm.querySelector('input[name=quantity]').textContent = data.new_quantity;
                    quantityForm.querySelector('#currentQuantity').textContent = data.new_quantity;
                    productPriceEle.textContent = formatMoney(productPriceEle.dataset.unitPrice * data.new_quantity);
                    this.updateShoppingCartAmounts();
                }
                else {
                    errorAlert(data.message);
                }
            })
            .catch(err => {
                console.log(err);
            });
    }

    updateShoppingCartAmounts() {
        const amountsForm = document.querySelector('#getAmountsForm');
        const formData = new FormData(amountsForm);
        
        fetch(amountsForm.action, {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                document.querySelector("#totalAmount").innerText = formatMoney(data.total_amount);
                document.querySelector("#discountAmount").innerText = formatMoney(data.discount_amount);
                document.querySelector("#final_amount").innerText = formatMoney(data.total_amount - data.discount_amount);
            })
            .catch(err => {
                console.log(err);
            });
    }
}