// Import vue-i18n
import { createI18n } from 'vue-i18n/index'

// Import language files
import fr from './fr.js'

// Create internationalization manager
export default createI18n({
  locale: 'fr', // set default locale
  messages: {
    fr
  }
})
