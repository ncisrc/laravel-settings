<template>
  <div class="NciSettingsInput">
    {{ setting.label }}
    {{ setting.text }}
    {{ setting.title }}
    {{ setting.path }}
    {{ setting.description }}

    <nci-input v-model:value="setting.value" type="text" :placeholder="$t('settings.input')" />
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

