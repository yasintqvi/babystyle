<script id="pagination-template" type="text/x-handlebars-template">
    @verbatim
    {{#if_gt last_page 1}}
    <div class="card">
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <nav class="d-flex justify-items-center w-100 justify-content-between">
                    <div class="d-flex justify-content-between flex-fill d-sm-none">
                        <ul id="pagination-mobile" class="pagination">
                            {{#each links}}
                                {{#if active}}
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" onclick="alert(this)" href="{{url}}">{{label}}</a>
                                    </li>
                                {{else}}
                                    <li class="page-item">
                                        <a class="page-link" onclick="alert(this)" href="{{url}}">{{label}}</a>
                                    </li>
                                {{/if}}
                            {{/each}}
                        </ul>
                    </div>
                    <div class="g">
                        <ul id="pagination-desktop" class="pagination d-none d-sm-flex">
                            {{#each links}}
                                {{#if active}}
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" onclick="filterRequest(event,this)" href="{{url}}">{{label}}</a>
                                    </li>
                                {{else}}
                                    <li class="page-item">
                                        <a class="page-link" onclick="filterRequest(event,this)" href="{{url}}">{{label}}</a>
                                    </li>
                                {{/if}}
                            {{/each}}
                        </ul>
                    </div>
                    <div class="d-none d-sm-flex align-items-sm-center justify-content-sm-between">
                        <div class="g">
                            <p class="small text-muted">
                                نمایش
                                <span id="result-start" class="fw-semibold">{{ to }}</span>
                                تا
                                <span id="result-end" class="fw-semibold"></span>
                                از
                                <span id="total-results" class="fw-semibold">{{total}}</span>
                                نتیجه
                            </p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    {{/if_gt}}
    @endverbatim
</script>