<template>
  <n-tabs type="line" animated>
      <n-tab-pane name="application" :tab="$t('settings.application')">
          <the-settings-application />
      </n-tab-pane>
  </n-tabs>
</template>

<script>
import TheSettingsApplication from "./views/TheSettingsApplication.vue";

import { mapStores }    from "pinia";
import { useSettings }  from '@/business/stores/useSettings'
import persistanceLayer from './mocks/MockPersistanceLayer';
import { NTabs, NTabPane } from "naive-ui";

export default {
  components: {
    TheSettingsApplication,
    NTabs,
    NTabPane
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
