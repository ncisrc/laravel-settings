<template>
  <InputSwitch v-model="value" />
</template>

<script>
import InputSwitch from 'primevue/inputswitch';

export default {
  components: {
    InputSwitch,
  },
  props: {
    value: Boolean,
  },
};
</script>