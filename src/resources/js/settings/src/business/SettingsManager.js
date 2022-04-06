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

    getPath(data) {
        var rAry = [];
        data.forEach((item) => parseItem("", item.code, rAry));
        console.log("Results:", rAry);
    }

    /**
     * Recursive Magic (c'était simple en fait...)
     */
    parseItem(prefix, code, ary) {
        const codePath = code.split('.');
        const name = codePath[0];
        const fullname = (prefix == '') ? name : `${prefix}.${name}`; //TODO FAH : traduction à mettre

        // On recherche si l'item existe déjà dans le tableau  
        let item = ary.find(item => item.key == fullname);

        // Sinon on le crée et on l'ajoute au tableau
        if (!item) {
            item = {
                key: fullname,
                label: `i18n-${fullname}`,
                childrens: []
            };
            ary.push(item);
        }

        // Puis on parse les suivants si c'est nécessaire
        if (codePath.length > 2) {
            const nextCode = codePath.splice(1).join('.');
            parseItem(fullname, nextCode, item.childrens)
        }
    }

    length() {
        return this.settings.length;
    }
}