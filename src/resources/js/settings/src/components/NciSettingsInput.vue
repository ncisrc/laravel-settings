<template>
  <div>
    <div class="nci-setting_item-container">
      <div class="nci-setting_item-label">
        {{ setting.label }}
      </div>
      <div class="nci-setting_item-code">{{ setting.code }}</div>
    </div>
    <div class="nci-setting_item-text">{{ setting.text }}</div>
      <InputText v-model:value="setting.value" :placeholder="$t('settings.input')" />
  </div>
</template>

<script>
import InputText from 'primevue/inputtext';

export default {
  components: {
   InputText,
  },
  props: {
    setting    : Object,
    placeholder: String,
  },
};
</script>

