<template>
  <div class="main">
    <nci-tabs>
      <nci-tab-pane :tab="$t('settings.application')">
        <the-settings-application />
      </nci-tab-pane>
      <nci-tab-pane :tab="$t('settings.users')">
        <the-settings-users />
      </nci-tab-pane>
    </nci-tabs>
  </div>
</template>

<script>
import { NciTabs, NciTabPane } from "@/components/ui/NciUI";
import TheSettingsApplication from "./views/TheSettingsApplication.vue";
import TheSettingsUsers from "./views/TheSettingsUsers.vue";

import { mapActions } from 'pinia';
import { useSettings } from '@/business/stores/useSettings'

import MockPersistanceLayer from './mocks/MockPersistanceLayer';
const persistanceLayer = new MockPersistanceLayer();

export default {
  components: {
    NciTabPane,
    NciTabs,
    TheSettingsApplication,
    TheSettingsUsers,
  },

  mounted() {
    this.refresh();
  },

  methods: {
    ...mapActions(useSettings, {settingsStoreLoad: 'load'}),

    refresh() {
      this.settingsStoreLoad(persistanceLayer);
    },
  },
};
</script>

<style lang="scss" scoped>
.main {
    margin: 8rem;
}

</style>