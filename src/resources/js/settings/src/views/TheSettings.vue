<template>
  <div>
    <div>
      <input v-model="settingType" type="radio" name="typeSettings" value="A"> {{ $t('settings.app') }}
      <input v-model="settingType" type="radio" name="typeSettings" value="U"> {{ $t('settings.user') }}
    </div>

    <div>
      <the-settings-pane :settingType="settingType"></the-settings-pane>
    </div>
  </div>
</template>

<script>
import TheSettingsPane from "./TheSettingsPane.vue";
import { mapStores }    from "pinia";
import { useSettings }  from '@/business/stores/useSettings'
import persistanceLayer from '../mocks/MockPersistanceLayer';

export default {
  components: {
    TheSettingsPane,
  },

  data() {
    return {
      settingType: "A",
    }
  },

  computed: {
    ...mapStores(useSettings)
  },

  mounted() {
    this.useSettingsStore.setTranslator(this.$t);
    this.useSettingsStore.load(persistanceLayer);
  },
};
</script>
