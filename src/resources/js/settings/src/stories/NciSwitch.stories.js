import MyNciSwitch from '../components/ui/NciSwitch';

export default {
  title: 'NciSettingsList/MyNciSwitch',
  component: MyNciSwitch,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciSwitch },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-switch v-model:value="value"/>',
});

export const NciSwitch = Template.bind({});
NciSwitch.args = {
  value: "",
};
