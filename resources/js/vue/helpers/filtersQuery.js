export function  buildFiltersParams(filters) {
    var filterQuery = {};

    for (let key in filters) {
        if(filters[key].name && filters[key].value) {
            filterQuery[filters[key].name] = filters[key].value;
        }
    }
    console.log("GET BUILD FILTERS", filterQuery);

    return filterQuery;
}