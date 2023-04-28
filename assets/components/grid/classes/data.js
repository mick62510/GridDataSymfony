export default class Data {
    data = [];
    actions = [];
    totalPages = 0;
    page = 1;
    count = 0;
    constructor(data, totalPages, page,count) {
        this.data = data;
        this.totalPages = totalPages;
        this.page = page;
        this.count = count;
    }

    getData() {
        return this.data;
    }

    getTotalPages() {
        return this.totalPages;
    }

    getPage() {
        return this.page;
    }
    getCount(){
        return this.count;
    }
}