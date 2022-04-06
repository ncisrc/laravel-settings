export default class SettingsManager {
    constructor(persistanceLayer) {
        this.settings = [];
        this.persistanceLayer = persistanceLayer;
    }

    loadAll() {
        const rawSettings = this.persistanceLayer.loadAll();
        this.settings = this.parseItem(rawSettings);
    }

    get() {
        return this.settings;
    }

    parseItem(settings) {
        // const code = .split(".");
        // key = setting;
        return settings;
    }

    length() {
        return this.settings.length;
    }
}