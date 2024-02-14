<template>
  <div>
    <div class="nci-setting_item-container">
      <div class="nci-setting_item-label">
        {{ setting.label }}
      </div>
      <div class="nci-setting_item-code">{{ setting.code }}</div>
    </div>
    <div class="nci-setting_item-value_switch">
      <InputSwitch v-model="setting.value" />
      <div class="nci-setting_item-text">{{ setting.text }}</div>
    </div>
  </div>
</template>

<script>
import InputSwitch from 'primevue/inputswitch';

export default {
  components: {
     InputSwitch,
  },
  props: {
    setting: Object,
  },
};
</script>