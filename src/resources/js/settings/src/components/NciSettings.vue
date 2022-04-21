<template>
  <div class="NciSettings">
    <component
      :is="`NciSettings${setting.getTypeInput()}`"
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