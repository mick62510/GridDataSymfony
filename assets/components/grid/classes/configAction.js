export default class ConfigAction {
    /**
     * @type {string}
     */
    color;

    /**
     * @type {string}
     */
    icon;

    setColor(value) {
        this.color = value;
    }

    setIcon(value) {
        this.icon = value;
    }

    /**
     * @returns {string}
     */
    getColor() {
        return this.color;
    }

    /**
     * @returns {string}
     */
    getIcon() {
        return this.icon;
    }

}