import Setting from '../business/objects/Setting';
import localeSettings from '../locales/fr/settings.js';
export default class MockPersistanceLayer {

    load() {
        return [
            new Setting(1, 'groupe1.sousgroupe1.param1', 'groupe1.sousgroupe1.param1', 'Number', null, null, false, true, "", false, "1/4", localeSettings.locale.groupe1.sousgroupe1.param1_label, localeSettings.locale.groupe1.sousgroupe1.param1_text),
            new Setting(2, 'groupe1.sousgroupe2.param1', 'groupe1.sousgroupe2.param1', 'Number', null, null, false, true, "", false, "1/4", localeSettings.locale.groupe1.sousgroupe1.param1_label, localeSettings.locale.groupe1.sousgroupe1.param1_text),
            new Setting(3, 'groupe1.param1', 'Premier test', 'Boolean', null, null, false, true, "", false, "1/4", localeSettings.locale.groupe1.sousgroupe1.param1_label, localeSettings.locale.groupe1.sousgroupe1.param1_text),
            new Setting(4, 'groupe1.param2', 'Deuxième test', 'Number', null, null, false, true, "", false, "1/4", localeSettings.locale.groupe1.sousgroupe1.param1_label, localeSettings.locale.groupe1.sousgroupe1.param1_text),
            new Setting(5, 'groupe1.param3', 'Troisième test', 'String', null, null, false, true, "", false, "1/4", localeSettings.locale.groupe1.sousgroupe1.param1_label, localeSettings.locale.groupe2.sousgroupe2.param1_text),
            new Setting(6, 'groupe1.param4', 'Quatrième test', 'Array', null, [
                {
                    label: "toto",
                    value: "toto",
                },
                {
                    label: "tata",
                    value: "tata",
                },
                {
                    label: "titi",
                    value: "titi",
                },
            ], false, true, "", false, "1/4", localeSettings.locale.groupe1.sousgroupe1.param1_label, localeSettings.locale.groupe2.sousgroupe2.param1_text),
            new Setting(7, 'groupe2.param1', 'groupe2.param1', 'Number', null, null, false, true, "", false, "1/4", localeSettings.locale.groupe2.sousgroupe2.param1_label, localeSettings.locale.groupe2.sousgroupe2.param1_text),
            new Setting(8, 'groupe2.sousgroupe2.param1', 'groupe2.sousgroupe2.param1', 'Boolean', null, null, false, true, "", false, "1/4",localeSettings.locale.groupe2.sousgroupe2.param1_label, localeSettings.locale.groupe2.sousgroupe2.param1_text),
        ];
    }
}