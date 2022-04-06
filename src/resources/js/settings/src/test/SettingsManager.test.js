import SettingsManager from "../business/SettingsManager";
import MockPersistanceLayer from "../mocks/MockPersistanceLayer";

test('create settingsManager', () => {
    const settingsManager = new SettingsManager(new MockPersistanceLayer)
    expect(settingsManager).not.toBe();
})

test('load settingsManager', () => {
    const settingsManager = new SettingsManager(new MockPersistanceLayer)
    settingsManager.loadAll();
    expect(settingsManager.length()).toBe(4);
})