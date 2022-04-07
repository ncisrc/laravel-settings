export default {

    settings: [],
    persistanceLayer: null,

    setPersistanceLayer(persistanceLayer) {
        this.persistanceLayer = persistanceLayer;
    },

    loadAll() {
        const rawSettings = this.persistanceLayer.loadAll();
        this.settings = this.getPath(rawSettings);
    },

    load(code) {
        let settingsList = this.persistanceLayer.loadAll().filter(item => {
            let path = item.code.split('.');
            let settingPath = ''
            for (let i = 0; i < path.length - 1; i++) {
                settingPath += path[i]
            }
            if (code === settingPath) return item;
        });
        return settingsList;
    },

    get() {
        return this.settings;
    },

    getPath(data) {
        var rAry = [];
        data.forEach((item) => this.parseItem("", item.code, rAry));
        return rAry;
    },

    /**
     * Recursive Magic (c'était simple en fait...)
     */
    parseItem(prefix, code, ary) {
        // console.log(prefix, code);
        const codePath = code.split('.');
        const name = codePath[0];
        const fullname = (prefix == '') ? name : `${prefix}.${name}`;

        // On recherche si l'item existe déjà dans le tableau  
        let item = ary.find(item => item.key == fullname);

        // Sinon on le crée et on l'ajoute au tableau
        if (!item) {
            item = {
                key: fullname,
                label: `i18n-${fullname}`,
                children: []
            };
            ary.push(item);
        }

        // Puis on parse les suivants si c'est nécessaire
        if (codePath.length > 2) {
            const nextCode = codePath.splice(1).join('.');
            this.parseItem(fullname, nextCode, item.children)
        }
    },

    length() {
        return this.settings.length;
    },
}