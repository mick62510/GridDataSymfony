import Config from "./config";
import Column from "./configColumn";
import Action from "./configAction";
import ConfigFilters from "./configFilters";


export default class ConfigFactory {

    /**
     * @param config
     * @returns {Config}
     */
    constructor(config) {
        let columns = this.createColumns(config.columns);
        let actions = this.createColumnActions(config.columnActions);
        let filters = this.createFilters(config.filters);

        return new Config(columns, actions,filters);
    }

    /**
     * @param configColumns
     * @returns {*[]}
     */
    createColumns(configColumns) {
        let columns = {};
        for (let index of Object.keys(configColumns)) {
            let configColumn = configColumns[index];
            let column = new Column();

            column.setTitle(configColumn.title);
            column.setHidden(configColumn.hidden);
            column.setDefault(configColumn.default);

            columns[index] = column;
        }
        return columns;
    }

    /**
     * @param configColumnActions
     * @returns {*[]}
     */
    createColumnActions(configColumnActions) {
        let actions = {};
        for (let index of Object.keys(configColumnActions)) {
            let configAction = configColumnActions[index];
            let action = new Action;

            action.setColor(configAction.color);
            action.setIcon(configAction.icon);

            actions[index] = action;
        }
        return actions;
    }
    /**
     * @param configFilters
     * @returns {*[]}
     */
    createFilters(configFilters) {
        let filters = {};
        for (let index of Object.keys(configFilters)) {
            let configFilter = configFilters[index];
            let filter = new ConfigFilters;

            filter.setTitle(configFilter.title);
            filter.setType(configFilter.type);
            filter.setOptions(configFilter.options);
            filters[index] = filter;
        }
        return filters;
    }
}