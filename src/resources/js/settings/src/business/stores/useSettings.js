import { defineStore } from 'pinia';
import Setting from "../objects/Setting";
import i18n from '../../locales';
import stringToPath from '../../libs/stringToPath';

export const useSettings = defineStore('useSettings', {
  state: () => {
    return {
      settings: [],
      translator: null,
      filter: "",
    }
  },

  getters: {
    applicationSettings() {
      return this.settings.filter(item => (item.overridable == false));
    },

    applicationSettingsFiltered() {
      return this.applicationSettings.filter(item => item.matchFilter(this.filter));
    },

    applicationSettingsPaths() {
      return stringToPath(this.applicationSettingsFiltered);
    },

    userSettings() {
      return this.settings.filter(item => (item.overridable == true));
    },

    userSettingsFiltered() {
      return this.userSettings.filter(item => item.matchFilter(this.filter));
    },

    userSettingsPaths() {
      return stringToPath(this.userSettingsFiltered);
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
    }

  }
});

