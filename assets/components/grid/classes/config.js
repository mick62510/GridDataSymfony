export default class Config {

    columns = [];
    columnActions = [];
    filters = [];

    /**
     * @returns {Object}
     */
    getColumns() {
        return this.columns;
    }

    constructor(columns, columnActions, filters) {
        this.columns = columns;
        this.columnActions = columnActions;
        this.filters = filters;
    }

    /**
     * @param index
     * @returns {ConfigColumn}
     */
    getColumn(index) {
        return this.columns[index];
    }

    /**
     * @returns {boolean}
     */
    hasAction() {
        return Object.keys(this.getColumnActions()).length > 0;
    }

    /**
     * @param index
     */
    updateColumnDefaultValue(index) {
        this.columns[index]['default'] = !this.columns[index]['default'];
    }

    /**
     * @returns {Object}
     */
    getColumnActions() {
        return this.columnActions;
    }

    /**
     * @param index
     * @returns ConfigAction
     */
    getColumnAction(index) {
        return this.columnActions[index];
    }

    /**
     * @returns {[]}
     */
    getFilters() {
        return this.filters;
    }

    /**
     * @returns {boolean}
     */
    hasFilters() {
        return Object.keys(this.getFilters()).length > 0;
    }
}