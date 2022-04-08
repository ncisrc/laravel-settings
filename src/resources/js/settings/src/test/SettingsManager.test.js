import useSettings from "../business/stores/useSettings";
import MockPersistanceLayer from "../mocks/MockPersistanceLayer";

test('create settingsManager', () => {
    const settingsManager = new useSettings(new MockPersistanceLayer)
    expect(settingsManager).not.toBe();
})

test('loadAll settingsManager', () => {
    const settingsManager = new useSettings(new MockPersistanceLayer)
    settingsManager.loadAll();
    expect(settingsManager.length()).toBe(2);
})

test('load settingsManager', () => {
    const settingsManager = new useSettings(new MockPersistanceLayer)
    settingsManager.loadAll();
    let aryResult = settingsManager.load('groupe1');
    expect(aryResult.length).toBe(3);
})