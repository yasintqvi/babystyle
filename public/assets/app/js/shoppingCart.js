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
                else if (data.auth) {
                    errorAlert('برای اضافه کردن محصول به سبد خرید ابتدا وارد حساب کاربری خود شوید.');
                    setTimeout(() => {
                        successAlert('در حال انتقال به صفحه ورود ...');
                        const loginUrl = "/login/?backUrl=" + window.location.pathname;
                        window.location.href = loginUrl;
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

    updateOrderAmounts(discountCode=null,shippingMethod=null) {
        const amountsForm = document.querySelector('#getAmountsForm');
        const formData = new FormData(amountsForm);

        formData.append('shipping_method_id', shippingMethod);
        formData.append('discount_code', discountCode);

        fetch(amountsForm.action, {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                document.querySelector("#totalAmount").innerText = formatMoney(data.total_amount) + ' تومان';
                document.querySelector("#discountAmount").innerText = formatMoney(data.discount_amount) + ' تومان';
                document.querySelector("#final_amount").innerText = formatMoney(data.total_amount - data.discount_amount)+ ' تومان';
                document.querySelector("#shipping_amount").innerText = formatMoney(data.shipping_method_amount)+ ' تومان';
                const discountText = document.getElementById('discount_text');
                if (document.querySelector('input[name=discount_code]').value.trim(' ') != '') {
                    if (data.discount_code_amount != 0) {
                        discountText.textContent = `مبلغ ${data.discount_code_amount} تومان از هزینه سفارشتان کسر گردید.`;
                    }
                    else {
                        discountText.textContent = `کد وارد شده اعتبار ندارد.`;
                    }
                }
                
            })
            .catch(err => {
                console.log(err);
            });
    }
}