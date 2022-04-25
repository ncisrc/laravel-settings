export default {

    load() {
        return [
            {id: 1, code:"test1.soustest1.param1", type:'Number', overridable:true, value: '123', favorite: true, width:"1/4"},
            {id: 2, code:"test1.soustest1.param2", type:'String', overridable:true, value: 'Hello World', favorite: false, width:"1/4"},
            {id: 3, code:"test1.soustest2.param3", type:'Boolean', overridable:true, value: true, favorite: true, width:"1/4"},
            {id: 4, code:"test1.soustest2.param4", type:'Boolean', overridable:true, value: false, favorite: false, width:"1/4"},
            {id: 5, code:"test1.soustest2.param5", type:'Array', options:[
                {label: "Test 1", value:"test1"},
                {label: "Test 2", value:"test2"},
                {label: "Test 3", value:"test3"},
            ], overridable:true, value: '123', favorite: true, width:"1/4"},
            {id: 6, code:"test1.soustest3.param1", type:'Number', overridable:true, value: '123', favorite: true, width:"1/4"}
        ];
    },

}
