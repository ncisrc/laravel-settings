<template>
  <div class="NciSettingsInput">
    <div class="flex w-full">
      <div>
        {{ setting.label }}
      </div>
      <div class="text-gray-500 ml-3">{{ setting.code }}</div>
    </div>
    <div class="flex w-full my-3">
      <nci-switch v-model:value="setting.value"/>
      <div class="ml-3">{{ setting.text }}</div>
    </div>
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