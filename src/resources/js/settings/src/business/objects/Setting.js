export default class Setting {
    constructor(data, localeEngine) {
        this.id            = data.id          || null;
        this.code          = data.code;
        this.type          = data.type        || 'String';
        this.options       = data.options     || null;
        this.nullable      = data.nullable    || true;
        this.overridable   = data.overridable || false;
        this.value         = data.value       || '';
        this.favorite      = data.favorite    || false;
        this.width         = data.width       || '1/4';

        const label_code   = `settings.code.${this.code}.label`;
        this.label         = localeEngine(label_code) || label_code;

        const label_text   = `settings.code.${this.code}.text`;
        this.text          = localeEngine(label_text) || '';
    }

    matchFilter(filter) {
        const filterLC   = filter.toLowerCase();
        const matchCode  = this.code.toLowerCase().includes(filterLC);
        const matchLabel = this.label.toLowerCase().includes(filterLC);
        const matchText  = this.text.toLowerCase().includes(filterLC);
        console.log(matchCode, matchLabel, matchText);
        return matchCode || matchLabel || matchText;
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
