import Setting from '../business/objects/Setting';

export default class MockPersistanceLayer {

    load() {
        return [
            new Setting(1, 'groupe1.sousgroupe1.param1', 'groupe1.sousgroupe1.param1', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(2, 'groupe1.sousgroupe2.param1', 'groupe1.sousgroupe2.param1', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(3, 'groupe1.param1', 'groupe1.param1', 'Boolean', null, null, false, true, "", false, "1/4"),
            new Setting(4, 'groupe1.param2', 'groupe1.param2', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(5, 'groupe1.param3', 'groupe1.param3', 'String', null, null, false, true, "", false, "1/4"),
            new Setting(6, 'groupe1.param4', 'groupe1.param4', 'Array', null, [
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
            ], false, true, "", false, "1/4"),
            new Setting(7, 'groupe2.param1', 'groupe2.param1', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(8, 'groupe2.sousgroupe2.param1', 'groupe2.sousgroupe2.param1', 'Number', null, null, false, true, "", false, "1/4"),
        ];
    }
}