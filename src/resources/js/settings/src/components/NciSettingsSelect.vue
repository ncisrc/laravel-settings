<template>
  <div>
    <div class="nci-setting_item-container">
      <div class="nci-setting_item-label">
        {{ setting.label }}
      </div>
      <div class="nci-setting_item-code">{{ setting.code }}</div>
    </div>
    <div class="nci-setting_item-text">{{ setting.text }}</div>

    <Dropdown v-model:value="setting.value" :options="setting.options" optionLabel="label" :placeholder="$t('settings.select')" />
  </div>
</template>

<script>
import Dropdown from 'primevue/dropdown';

export default {
  components: {
    Dropdown,
  },
  props: {
    setting   : Object,
    filterable: Boolean,
  },
};
</script>