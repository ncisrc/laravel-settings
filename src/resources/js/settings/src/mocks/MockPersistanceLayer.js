export default class MockPersistanceLayer {

    loadAll() {
        return [
            {
                label: "coucou",
                key: "1",
                children: [{ label: "test", key: "11" }],
            },
            {
                label: "hello",
                key: "2",
                children: [
                    { label: "test", key: "21" },
                    { label: "test2", key: "22" }
                ],
            },
            {
                label: "gutentag",
                key: "3",
                children: [{ label: "test", key: "31" }],
            },
            {
                label: "hola",
                key: "4",
                children: [{ label: "test", key: "41" }],
            },
        ];

    }
}