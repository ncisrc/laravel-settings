<template>
  <div class="NciSettingsInput">
    <div class="flex w-full">
      <div>
        {{ setting.label }}
      </div>
      <div class="text-gray-500 ml-3">{{ setting.code }}</div>
    </div>
    <div class="w-full my-3">{{ setting.text }}</div>
    
    <nci-input
      v-model:value="setting.value"
      type="text"
      :placeholder="$t('settings.input')"
    />
  </div>
</template>

<script>
import { NciInput } from "./ui/NciUI";

export default {
  components: {
    NciInput,
  },
  props: {
    setting    : Object,
    placeholder: String,
  },
};
</script>

