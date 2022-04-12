<template>
  <div class="NciSettings">
    <nci-settings-input
      v-if="setting.type == 'String' || setting.type == 'Number'"
      :setting="setting"
      :placeholder="placeholder"
    />
    <nci-settings-select
      v-if="setting.type == 'Array'"
      :setting="setting"
      :placeholder="placeholder"
      :multiple="true"
      :filterable="true"
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
    multiple: Boolean,
    setting: Object,
    placeholder: String,
    filterable: String,
  },
};
</script>

<style lang="scss" scoped>

.NciSettings {
  border: 1px solid black;
  padding: 1rem;
  margin: 1rem;
}
.settingsLabel {
  font-weight: bold;
}
</style>