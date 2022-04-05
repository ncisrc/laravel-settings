export default class Setting {
    constructor(id, code, description, type, options_class = null, options_data = null, nullable, overridable = true, default_ , favorite = false, width = "1/4") {
        this.id = id;
        this.code = code;
        this.description = description;
        this.type = type;
        this.options_class = options_class;
        this.options_data = options_data;
        this.nullable = nullable;
        this.overridable = overridable;
        this.default_ = default_;
        this.favorite = favorite;
        this.width = width;
    }

    sum(a, b){
        return a+b;
    }
}