const setupDatePickerValidation = (
  startDate,
  endDate,
  inputFieldId,
  inputFieldBtnId
) => {
  const validateDatePicker = () => {
    const inputField = document.getElementById(inputFieldId);
    const altValue = inputField.getAttribute('data-alt-value');

    if (!altValue) {
      return;
    }

    const selectedDate = new Date(altValue);
    const currentDate = new Date();
    const days = document.querySelectorAll('.day');
    setTimeout(() => {
      days.forEach((day) => {
        const dayValue = parseInt(day.textContent);
        const dayDate = new Date(
          selectedDate.getFullYear(),
          selectedDate.getMonth(),
          dayValue
        );

        let isDisabled = false;
        if (dayDate < startDate || dayDate > endDate) {
          isDisabled = true;
        }

        day.classList.toggle('disabled', isDisabled);
        day.style.pointerEvents = isDisabled ? 'none' : 'auto';
      });
    });
  };

  const inputField = document.getElementById(inputFieldId);
  const inputFieldBtn = document.getElementById(inputFieldBtnId);

  inputField.addEventListener('change', validateDatePicker);
  inputFieldBtn.addEventListener('click', validateDatePicker);
  validateDatePicker();
};

export { setupDatePickerValidation };
