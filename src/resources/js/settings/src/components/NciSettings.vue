<template>
  <div>
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