import Setting from '@/business/objects/Setting';

export default class MockPersistanceLayer {

    loadAll() {
        return [
            new Setting(1, 'groupe1.sousgroupe1.param1', 'groupe1.sousgroupe1.param1', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(2, 'groupe1.param1', 'groupe1.param1', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(3, 'groupe1.param2', 'groupe1.param2', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(4, 'groupe1.param3', 'groupe1.param3', 'Number', null, null, false, true, "", false, "1/4"),
            new Setting(5, 'groupe2.param1', 'groupe2.param1', 'Number', null, null, false, true, "", false, "1/4"),
        ];
    }
}