<template>
  <div class="NciTabs">
    <n-tabs type="line" animated>
        <n-tab-pane name="application" :tab="$t('settings.application')">
            <slot name="settingsApplication" />
        </n-tab-pane>
        <n-tab-pane name="users" :tab="$t('settings.users')">
           <slot name="settingsUsers" />
        </n-tab-pane>
    </n-tabs>
  </div>
</template>

<script>
import { NTabs, NTabPane } from "naive-ui";

export default {
  components: {
    NTabs,
    NTabPane,
  },
  props: {
    name: String,
    tab: String
  },
};
</script>