<template>
  <div class="NciSettingsInput">
    <div class="flex w-full">
      <div>
        {{ setting.label }}
      </div>
      <div class="text-gray-500 ml-3">{{ setting.code }}</div>
    </div>
    <div class="w-full my-3">{{ setting.text }}</div>

    <nci-select
      v-model:value="setting.value"
      filterable
      :options="setting.options"
      :placeholder="$t('settings.select')"
    />
  </div>
</template>

<script>
import NciSelect from "./ui/NciSelect.vue";

export default {
  components: {
    NciSelect,
  },
  props: {
    setting   : Object,
    filterable: Boolean,
  },
};
</script>