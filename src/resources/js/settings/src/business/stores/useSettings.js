import { defineStore } from 'pinia';
import Setting from "../objects/Setting";
import i18n from '../../locales';

export const useSettings = defineStore('useSettings', {
  state: () => {
    return {
      settings: [],
      translator: null,
    }
  },

  getters: {
    applicationSettings() {
      return this.settings.filter(item => (item.overridable == true));
    },

    applicationSettingPaths() {
      var rAry = [];
      this.applicationSettings.map((item) => this.stringToPath("", item.code, rAry, item.localeEngine));
      return rAry;
    },

    userSettings() {
      return this.settings.filter(item => (item.overridable == false));
    },

    userSettingPath() {
      var rAry = [];
      this.applicationSettings.map((item) => this.stringToPath("", item.code, rAry, item.localeEngine));
      return rAry;
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


  }
});

