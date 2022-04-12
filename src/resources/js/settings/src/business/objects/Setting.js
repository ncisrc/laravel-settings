export default class Setting {
    constructor(id, code, description, type, options_class = null, options_data = null, nullable, overridable = true, default_, favorite = false, width = "1/4", label, text) {
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
        this.label = label;
        this.text = text;
    }

    getId() {
        return this.id;
    }

    getCode() {
        return this.code;
    }

    getDescription() {
        return this.description;
    }

    getType() {
        return this.type;
    }

    getOptions() {
        return this.options_data;
    }

    getNullable() {
        return this.nullable;
    }

    getOverridable() {
        return this.overridable;
    }

    getDefault() {
        return this.default_;
    }

    getFavorite() {
        return this.Favorite;
    }

    getWidth() {
        return this.width;
    }

    getLabel() {
        return this.label;
    }

    getText() {
        return this.text;
    }
}