export default class Setting {
    constructor(data, localeEngine) {
        this.localeEngine  = localeEngine;

        this.id            = data.id          || null;
        this.code          = data.code;
        this.type          = data.type        || 'String';
        this.options       = data.options     || null;
        this.nullable      = data.nullable    || true;
        this.overridable   = data.overridable || false;
        this.value         = data.value       || (this.type == 'Boolean' ? false : '');
        this.favorite      = data.favorite    || false;
        this.width         = data.width       || '1/4';

        const label_code   = `settings.code.${this.code}.label`;
        this.label         = this.localeEngine(label_code) || label_code;

        const label_text   = `settings.code.${this.code}.text`;
        this.text          = this.localeEngine(label_text) || '';
    }

    matchFilter(filter) {
        if (filter == "" ) return true;
        const filterLC   = filter.toLowerCase();
        const matchCode  = this.code.toLowerCase().includes(filterLC);
        const matchLabel = this.label.toLowerCase().includes(filterLC);
        const matchText  = this.text.toLowerCase().includes(filterLC);
        return matchCode || matchLabel || matchText;
    }

    matchCode(key) {
        if (key == "" ) return true;
        const keyLC = key.toLowerCase();
        const matchCode  = this.code.toLowerCase().includes(keyLC);
        return matchCode;
    }

    getTypeInput() {
        let typeInput = "";
        if (this.type == 'String' || this.type == 'Number') typeInput = "Input"
        if (this.type == 'Array') typeInput = "Select"
        if (this.type == 'Boolean') typeInput = "Switch"
        return typeInput;
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
