<template>
  <div>
    <nci-settings-input
      v-if="setting.type == 'String' || setting.type == 'Number'"
      :setting="setting"
      :placeholder="placeholder"
    />

    <nci-settings-select
      v-if="setting.type == 'Array'"
      :setting="setting"
      :placeholder="placeholder"
    />

    <nci-settings-switch
      v-if="setting.type == 'Boolean'"
      :setting="setting"
      :placeholder="placeholder"
    />
  </div>
</template>

<script>
import NciSettingsInput from "./NciSettingsInput.vue";
import NciSettingsSelect from "./NciSettingsSelect.vue";
import NciSettingsSwitch from "./NciSettingsSwitch.vue";

export default {
  components: {
    NciSettingsInput,
    NciSettingsSelect,
    NciSettingsSwitch,
  },
  props: {
    setting: Object,
    placeholder: String,
  },
};
</script>