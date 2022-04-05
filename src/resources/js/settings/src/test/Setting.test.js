import Setting from "../business/Setting";

test('add', () => {
    const setting = new Setting(1,'test','test','Number',null, null, false,true, "", false, "1/4")
    expect(setting.sum(1,2)).toBe(3);
})