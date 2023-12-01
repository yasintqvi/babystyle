Handlebars.registerHelper('if_gt', function(value, comparison, options) {
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
    const reqUrl = await handleUrl(url);
    let data = await fetchData(url);
    console.log(data);
    var templateSource = document.getElementById("table-template").innerHTML;
    var template = Handlebars.compile(templateSource);

    data.data.forEach(item => {
        item['edit_route'] = `/admin/market/categories/${item.id}/edit`;
    });

    // اعمال داده‌های متغیر به قالب
    var html = template(data);

    // نمایش قالب در المان مورد نظر
    document.getElementById("table-container").innerHTML = html;

    handlePaginate(data);
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

function filterRequest(event, reqUrl) {
    event.preventDefault();
    handleData(reqUrl);
}

function searchRequest(element) {
    const url = `${defaultUrl}?search=${element.value}`;
    handleData(url)
}