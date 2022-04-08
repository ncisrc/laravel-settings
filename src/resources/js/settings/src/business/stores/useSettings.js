import { defineStore } from 'pinia';

export const useSettings = defineStore('useSettings', {
    state: () => {
        return {
            settings: []
        }
    },

    getters: {
        settingsPath() {
            var rAry = [];
            this.settings.forEach((item) => stringToPath("", item.code, rAry));
            return rAry;
        },
    },

    actions : {
        load(persistanceLayer) {
            this.settings = persistanceLayer.load();
        },

        get(partialCode) {
            const len = partialCode.length;
            return this.settings.filter((item) => item.code.subString(0, len) == partialCode);
        },

        find(code) {
            return this.settings.find((item) => item.code == code);
        },

        length() {
            return this.settings.length;
        },

        listParams(code) {
            return this.settings.filter((item) => code == item.code.substring(0, item.code.lastIndexOf(".")));
        }
    }
});

/**
 * Recursive Magic (c'était simple en fait...)
 */
function stringToPath(prefix, code, ary) {
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
       stringToPath(fullname, nextCode, item.children)
   }
}
