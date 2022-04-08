<template>
  <div>
    <n-tabs type="line" animated>
      <n-tab-pane name="application" tab="application">
        <the-settings-application />
      </n-tab-pane>
      <n-tab-pane name="users" tab="users">
        <the-settings-users />
      </n-tab-pane>
    </n-tabs>
  </div>
</template>

<script>
import { NTabs, NTabPane } from "naive-ui";

import TheSettingsApplication from "./views/TheSettingsApplication.vue";
import TheSettingsUsers from "./views/TheSettingsUsers.vue";

import { mapActions } from 'pinia';
import { useSettings } from '@/business/stores/useSettings'

import MockPersistanceLayer from './mocks/MockPersistanceLayer';
const persistanceLayer = new MockPersistanceLayer();

export default {
  components: {
    NTabPane,
    NTabs,
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
    }
  }
};
</script>

<style lang="scss">
 .NciSettingsInput {
    border: 1px solid black;
    margin: 2rem;
    padding: 2rem;
}
</style>