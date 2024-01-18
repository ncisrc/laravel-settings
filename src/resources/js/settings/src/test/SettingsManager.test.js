import { useSettings } from "../business/stores/useSettings";

import { setActivePinia, createPinia } from 'pinia'

// test('create settingsManager', () => {
//     const settingsManager = new useSettings(new MockPersistanceLayer)
//     expect(settingsManager).not.toBe();
// })

// test('loadAll settingsManager', () => {
//     const settingsManager = new useSettings(new MockPersistanceLayer)
//     settingsManager.loadAll();
//     expect(settingsManager.length()).toBe(2);
// })

// test('load settingsManager', () => {
//     const settingsManager = new useSettings(new MockPersistanceLayer)
//     settingsManager.loadAll();
//     let aryResult = settingsManager.load('groupe1');
//     expect(aryResult.length).toBe(3);
// })

describe('user Settings', () => {
    beforeEach(() => {
      // creates a fresh pinia and make it active so it's automatically picked
      // up by any useStore() call without having to pass it to it:
      // `useStore(pinia)`
      setActivePinia(createPinia())
    })

    it('create', () => {
        const settingsManager = useSettings();
        expect(settingsManager).not.toBe();
    })

    it('load', () => {
        const settingsManager = useSettings();
        console.log(settingsManager);
        // expect(settingsManager.length()).toBe(1)
    })
})