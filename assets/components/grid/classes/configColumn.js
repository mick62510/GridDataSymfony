export default class ConfigColumn {
    /**
     * @type {boolean}
     */
    default;
    /**
     * @type {boolean}
     */
    hidden;
    /**
     * @type {string}
     */
    title;

    setDefault(value) {
        this.default = value;
    }

    setHidden(value) {
        this.hidden = value;
    }

    setTitle(value) {
        this.title = value;
    }

    /**
     * @returns {boolean}
     */
    isDefault() {
        return this.default;
    }

    /**
     * @returns {boolean}
     */
    isHidden() {
        return this.hidden;
    }

    /**
     * @returns {string}
     */
    getTitle() {
        return this.title;
    }
}