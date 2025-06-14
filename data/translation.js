function loadLanguage(lang) {
  $.getJSON(`data/${lang}.json`, function (data) {
    $('[data-i18n]').each(function () {
      const key = $(this).data('i18n');        // e.g. "school.name"
      const attr = $(this).data('i18n-attr') || 'text'; // defaults to text
      const value = getNestedValue(data, key); // gets value from JSON
      if (value) {
        if (attr === 'text') {
          $(this).text(value);
        } else {
          $(this).attr(attr, value);
        }
      }
    });


    // Handle extra attribute-specific keys
    $('[data-i18n-title]').each(function () {
      const key = $(this).data('i18n-title');
      const value = getNestedValue(data, key);
      if (value) {
        $(this).attr('title', value);
      }
    });

    localStorage.setItem('lang', lang);
  });
}

// Helper to support nested key lookup with dot notation
function getNestedValue(obj, key) {
  return key.split('.').reduce((o, k) => (o || {})[k], obj);
}

$(document).ready(function () {
  const savedLang = localStorage.getItem('lang') || 'np';
  $('#lang-switcher').val(savedLang);
  loadLanguage(savedLang);

  $('#lang-switcher').on('change', function () {
    const selectedLang = $(this).val();
    loadLanguage(selectedLang);
  });
});
