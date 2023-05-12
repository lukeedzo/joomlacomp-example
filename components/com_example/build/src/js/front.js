import { setupDatePickerValidation } from './modules/dateValidation.module';

document.addEventListener('DOMContentLoaded', () => {
  const seasonData = document.getElementById('season-data');

  if (seasonData) {
    // Get season data
    const data = JSON.parse(seasonData.textContent);

    const startDate = new Date(data.date_from);
    const endDate = new Date(data.date_to);
    startDate.setDate(startDate.getDate() - 1);
    endDate.setDate(endDate.getDate());

    setupDatePickerValidation(
      startDate,
      endDate,
      'jform_date_from',
      'jform_date_from_btn'
    );
    setupDatePickerValidation(
      startDate,
      endDate,
      'jform_date_to',
      'jform_date_to_btn'
    );
  }
});
