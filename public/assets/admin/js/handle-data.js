Handlebars.registerHelper('if_gt', function (value, comparison, options) {
    if (value > comparison) {
        return options.fn(this);
    } else {
        return options.inverse(this);
    }
});

async function fetchData(reqUrl = "") {
    const fullUrl = reqUrl || defaultUrl;
    try {
        const response = await fetch(fullUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();

        return data;
    } catch (err) {
        console.error('Error: ', error);
    }
}

async function handleData(url = "") {
    
    await Handlebars.registerHelper('ifEquals', function(arg1, arg2, options) {
        return (arg1 == arg2) ? options.fn(this) : options.inverse(this);
    });

    await Handlebars.registerHelper('ifNotEquals', function(arg1, arg2, options) {
        return (arg1 != arg2) ? options.fn(this) : options.inverse(this);
    });


    const reqUrl = await handleUrl(url);
    let data = await fetchData(url);
    var templateSource = document.getElementById("table-template").innerHTML;
    var template = Handlebars.compile(templateSource);
    var html = await template(data);

    document.getElementById("table-container").innerHTML = html;

    handlePaginate(data);

    document.querySelectorAll('.money').forEach((item) => {
        const regex = /(\d)(?=(\d{3})+$)/g;
        item.textContent = item.textContent.toString().replace(regex, '$1,');
    })

    handleBatchOperation();
}

function handleUrl(newUrl) {
    if (!newUrl) {
        return false;
    }
    const url = window.location.href;
    const urlObj = new URL(url);
    const newUrlObj = new URL(newUrl);
    const searchParams = urlObj.searchParams;

    newUrlObj.searchParams.forEach((value, key) => {
        searchParams.set(key, value);
    });

    return urlObj.toString();
}

function handlePaginate(data) {
    data.links[0].label = `قبلی`;
    data.links[data.links.length - 1].label = `بعدی`;

    var paginateTemplate = document.getElementById("pagination-template").innerHTML;
    var template = Handlebars.compile(paginateTemplate);
    var html = template(data);

    document.getElementById("pagination-container").innerHTML = html;
}

function handleBatchOperation() {
    const batchInputs = document.querySelectorAll('.batch-inputs');
    const selectAllInput = document.getElementById('selectAll');
    const btnBatchOperation = document.getElementById('btn-batch-operation');

    selectAllInput.addEventListener('change', function () {
        if (this.checked) {
            batchInputs.forEach(function (checkbox) {
                checkbox.checked = true;
            });
            btnBatchOperation.classList.remove('d-none');
        } else {
            batchInputs.forEach(function (checkbox) {
                checkbox.checked = false;
            });
            btnBatchOperation.classList.add('d-none');
        }
    });

    batchInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            if (document.querySelectorAll('.batch-inputs:checked').length > 0) {
                btnBatchOperation.classList.remove('d-none');
            } else {
                btnBatchOperation.classList.add('d-none');
            }
        });
    });
}

function filterRequest(event, reqUrl) {
    event.preventDefault();
    handleData(reqUrl);
}

function searchRequest(element) {
    const url = `${defaultUrl}?search=${element.value}`;
    handleData(url)
}

function batchDelete(e) {
    e.preventDefault();
    const batchDeleteForm = document.querySelector('#table-container');

    Swal.fire({
        title: 'مطمئن هستید؟',
        text: "در صورت حذف امکان بازیابی مجدد وجود ندارد",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'بله حذف شود!'
    }).then(function (result) {
        if (result.value) {
            batchDeleteForm.submit();
        }
    });
    e.preventDefault();
}


function batchEdit(e) {
    e.preventDefault();
    const batchInputs = document.querySelectorAll('.batch-inputs');

    batchInputs.forEach(function (checkbox) {
        if (checkbox.checked) {
            window.open(checkbox.dataset.edit, '_blank');
        }
    });

}