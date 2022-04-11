<template>
  <div class="NciSettingsInput">
    {{ setting.title }}
    {{ setting.path }}
    {{ setting.description }}

    <nci-select
      v-model:value="setting.value"
      :multiple = "multiple"
      :filterable = "filterable"
      :options="setting.options_data"
      :placeholder="$t('settings.select')"
    />
  </div>
</template>

<script>
import NciSelect from "./ui/NciSelect.vue"

export default {
  components: {
    NciSelect,
  },
  props: {
    setting   : Object,
    multiple  : Boolean,
    filterable: Boolean,
  },
};
</script>