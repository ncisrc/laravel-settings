<template>
  <div class="NciSettingsInput">
    {{ setting.title }}
    {{ setting.path }}
    {{ setting.description }}

    <nci-switch v-model:value="setting.value"/>
  </div>
</template>

<script>
import NciSwitch from "./ui/NciSwitch.vue";

export default {
  components: {
    NciSwitch,
  },
  props: {
    setting: Object,
  },
};
</script>