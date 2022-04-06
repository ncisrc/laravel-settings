import Setting from "../business/Setting";

test('create setting', () => {
    const setting = new Setting(1,'test','test','Number',null, null, false,true, "", false, "1/4")
    expect(setting).not.toBe();
})

