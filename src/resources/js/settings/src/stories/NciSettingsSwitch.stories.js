import MyNciSettingsSwitch from '../components/NciSettingsSwitch';

export default {
  title: 'NciSettingsList/MyNciSettingsSwitch',
  component: MyNciSettingsSwitch,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciSettingsSwitch },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-settings-switch v-model:value="value"/>',
});

export const NciSettingsSwitch = Template.bind({});
NciSettingsSwitch.args = {
  value: "",
};
