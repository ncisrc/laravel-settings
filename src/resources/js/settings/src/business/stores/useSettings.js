import { defineStore } from 'pinia';
import Setting from "../objects/Setting";

export const useSettings = defineStore('useSettings', {
  state: () => {
    return {
      settings: [],
      translator: null,
      filter: "",
      key:"",
    }
  },

  getters: {
    applicationSettings() {
      return this.settings.filter(item => (item.overridable == false));
    },

    applicationSettingsFiltered() {
      return this.applicationSettings.filter(item => item.matchCode(this.key)).filter(item => item.matchFilter(this.filter));
    },

    applicationSettingsPaths() {
      return this.stringToPath(this.applicationSettings);
    },

    userSettings() {
      return this.settings.filter(item => (item.overridable == true));
    },

    userSettingsFiltered() {
      return this.userSettings.filter(item => item.matchCode(this.key)).filter(item => item.matchFilter(this.filter));
    },

    userSettingsPaths() {
      return this.stringToPath(this.userSettings);
    },

    length() {
      return this.settings.length;
    },
  },

  actions : {
    setTranslator(translator) {
      this.translator = translator;
    },

    load(persistanceLayer) {
      const data = persistanceLayer.load();

      this.settings = data.map(item => {
        return new Setting(item, this.translator);
      });
      console.log(this.settings);
    },

    all() {
      return this.settings;
    },

    get(partialCode) {
      const len = partialCode.length;
      return this.settings.filter((item) => item.code.subString(0, len) == partialCode);
    },

    find(code) {
      return this.settings.find((item) => item.code == code);
    },

    setFilter(filter){
      this.filter = filter;
    },

    setKey(key){
      this.key != key ? this.key = key : this.key = "";
    },

    stringToPath(items) {
      var rAry = [];
      items.forEach(item => this.recursivePathFinder("", item.code, rAry, item.localeEngine));
      return rAry;
    },

    recursivePathFinder(prefix, code, ary, localeEngine) {
      const codePath = code.split('.');
      const name     = codePath[0];
      const fullname = (prefix == '') ? name : `${prefix}.${name}`;

      // On recherche si l'item existe déjà dans le tableau
      let item = ary.find(item => item.key == fullname);

      // Sinon on le crée et on l'ajoute au tableau
      if (!item) {
        item = {
          key : fullname,
          label : localeEngine(`settings.menu.${fullname}_label`),
          children : []
        }
        ary.push(item);
      }

      // Puis on parse les suivants si c'est nécessaire
      if (codePath.length > 2) {
        const nextCode = codePath.splice(1).join('.');
        this.recursivePathFinder(fullname, nextCode, item.children, localeEngine)
      }
    }

  }
});
