export default class ConfigFilters {
    /**
     * @type {Array}
     */
    options;
    /**
     * @type {String}
     */
    type;
    /**
     * @type {string}
     */
    title;

    setType(type) {
        this.type = type;
    }

    /**
     * @returns {String}
     */
    getType() {
        return this.type;
    }

    /**
     * @returns {string}
     */
    getTitle() {
        return this.title;
    }

    setTitle(value) {
        this.title = value;
    }

    /**
     * @returns {Array}
     */
    getOptions() {
        return this.options;
    }

    setOptions(options) {
        this.options = options;
    }


}