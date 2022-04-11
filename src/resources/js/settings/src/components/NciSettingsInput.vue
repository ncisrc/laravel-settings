<template>
  <div class="NciSettingsInput">
    {{ setting.title }}
    {{ setting.path }}
    {{ setting.description }}

    <nci-input v-model:value="setting.value" type="text" :placeholder="placeholder" />
  </div>
</template>

<script>
import { NciInput } from "./ui/NciUI";

export default {
  components: {
    NciInput,
  },
  props: {
    setting: Object,
    placeholder: String,
  },
};
</script>

