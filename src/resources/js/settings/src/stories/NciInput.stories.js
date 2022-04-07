import MyNciInput from '../components/ui/NciInput';

export default {
  title: 'NciSettingsList/MyNciInput',
  component: MyNciInput,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciInput },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-input v-model:value="value"/>',
});

export const NciInput = Template.bind({});
NciInput.args = {
  value: "",
};
